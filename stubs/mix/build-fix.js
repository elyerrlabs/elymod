const fs = require('fs');
const path = require('path');

function fixCss() {
    // module name
    const modulePath = path.basename(__dirname);
    // css file
    const cssFile = path.resolve(__dirname, 'public/css/app.css');
    
    if (!fs.existsSync(cssFile)) return;

    let css = fs.readFileSync(cssFile, 'utf8');

    // re-write url(/fonts) to url(/third-party/ModuleName/fonts)
    const fixed = css.replaceAll(
        /(?<!third-party\/[^/]+)\/fonts\//g,
        `/third-party/${modulePath}/fonts/`
    );

    if (fixed !== css) {
        fs.writeFileSync(cssFile, fixed);
    }
}

module.exports = fixCss;