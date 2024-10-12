import gulp from "gulp";
import { spawn } from "child_process"; // Use spawn instead of exec
import WebSocket, { WebSocketServer } from "ws";
import chalk from "chalk";
import { log } from "console";

console.warn = function(message) {
  console.log(chalk.yellow(message));
}

class PhpServerManager {
  #phpServer;
  constructor(PORT = 5000) {
    this.PORT = PORT;
    this.#phpServer = spawn("php", ["-S", `localhost:${this.PORT}`, "-t", "src/"]);
    this.#initServer();
  }

  #initServer() {
    this.#phpServer.stderr.on("data", this.#onData);
    this.#phpServer.stderr.on("error", this.#onError);
    
    this.#phpServer.stdout.on("data", this.#onData);
    this.#phpServer.stdout.on("error", this.#onError);
    

    this.#phpServer.on("close", this.#onClose);
    this.killServerProcess();
  }

  #onData = (data) => {
    log(chalk.green(data.toString()));
  };

  #onClose = (code) => {
    log(chalk.yellow(`PHP server exited with code: ${code}`));
  };

  #onError = (err) => {
    console.error(chalk.red(err.toString()));
  };

  terminateServer(code) {
    log("Stopping PHP server...");
    this.#phpServer.kill();
    process.exit(code);
  }

  killServerProcess() {
    process.on("SIGINT", () => this.terminateServer(0));
    process.on("SIGTERM", () => this.terminateServer(0));
    process.on("uncaughtException", (err) => {
      console.error(chalk.red("Uncaught Exception:", err));
      this.terminateServer(1);
    });
  }
}

class WebSocketManager {
  constructor(PORT = 3001) {
    this.WSS = new WebSocketServer({ port: PORT });
    this.#connectWSS();
  }

  #connectWSS() {
    this.WSS.on("connection", this.#handleConnection);
  }

  #handleConnection = (ws) => {
    console.warn("Client connected");
    ws.on("message", this.#handleMessage);
  };

  #handleMessage = (msg) => {
    console.warn("Received: %s", msg);
  };

  sendReloadSignal() {
    this.WSS.clients.forEach((client) => {
      if (client.readyState === WebSocket.OPEN) {
        client.send("reload");
      }
    });
  }
}

class ManageTasks {
  #wss;
  #phpServer;

  constructor() {
    this.#wss = new WebSocketManager();
    this.#phpServer = new PhpServerManager(9000);
    gulp.task("serve", this.#init);
    gulp.task("default", gulp.series("serve"));
  }

  #init = (done) => {
    try {
      gulp.watch("**/*.php").on("change", this.#handleChange);
    } catch (error) {
      console.error(chalk.red("Error initializing ManageTasks:", error));
      this.#phpServer.terminateServer(1);
    } finally {
      done();
    }
  };

  #handleChange = () => {
    console.log("PHP file changed, sending reload signal...");
    this.#wss.sendReloadSignal();
  };
}

// RUN GULP 
new ManageTasks();