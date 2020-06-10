var routes = require('./routes');

export default function () {
    // Делаем копию полученых аргументов
    var args = Array.prototype.slice.call(arguments);
    var name = args.shift();

    if (routes[name] === undefined) {
        console.error('Error');
    } else {
        return '/' + routes[name]
            .split('/')
            .map(str => {
                return str[0] === "{" ? args.shift() : str;
            })
            .join('/');
    }
}
