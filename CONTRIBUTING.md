## Development Commands

To install the needed packages, go into the plugin folder and run `npm install`.

After that, use `npm run <command>` to run a command. The following commands are available:

* `npm run build`: Runs all the JavaScript files in `assets/js/src` through Babel and UglifyJS. The resulting JS files are saved in `assets/js`.
* `npm run watch`: Looks for any changes to the JS files and runs the build command if necessary.
