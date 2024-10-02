import gulp from "gulp";
import {WebSocketServer} from 'ws';
import open from "open";
import { exec } from "child_process";

const wss = new WebSocketServer({ port: 3001 });
const PORT = 5000;

exec(`php -S localhost:${PORT} -t src/`, (err, stdout, stderr) => {
    if (err) {
        console.error(err);
        return;
    }
    console.log(stdout);
    console.error(stderr);
});
const handleExit = () => {
    console.log('Stopping PHP server...');
    phpServer.kill();  // Kills the PHP server process
    process.exit();
}
// Handle process exit signals
process.on("SIGINT", handleExit);   // For Ctrl+C in terminal
process.on("SIGTERM", handleExit);  // For kill commands
process.on("exit", handleExit);     // On normal process exit

wss.on('connection', ws => {
    console.log('Client connected');
    ws.on('message', message => {
        console.log('Received: %s', message);
    });
});

gulp.task('serve', () => {
    // Watch for PHP file changes
    gulp.watch("**/*.php").on("change", () => {
        console.log('PHP file changed, sending reload signal...');

        // Send reload signal to WebSocket clients
        wss.clients.forEach(client => {
            if (client.readyState === WebSocket.OPEN) {
                client.send('reload');
            }
        });
    });

    // Automatically open 'hello-world.test' in the browser
    open(`http://localhost:${PORT}`);  // This will open the browser to the specified URL
});

gulp.task('default', gulp.series('serve'));
