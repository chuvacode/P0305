var routes = require('./routes')

export default function () {
  // Делаем копию полученых аргументов
  const args = Array.prototype.slice.call(arguments)
  const name = args.shift()

  if (routes[name].indexOf('http') > -1) {
    return routes[name]
      .split('/')
      .map(str => str[0] === '{' ? args.shift() : str)
      .join('/')
  }

  if (routes[name] === undefined) {
    console.error('Error')
  } else {
    return '/' + routes[name]
      .split('/')
      .map(str => str[0] === '{' ? args.shift() : str)
      .join('/')
  }
}
