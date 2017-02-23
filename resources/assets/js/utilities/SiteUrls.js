let URL = require('url-parse')

let currentUrl = new URL(window.location.href)
let urlPath = currentUrl.pathname.split('/')

// Get the Business, which will be at index 1 in the path array
let business = urlPath[1]

module.exports = {
    businessWebUrl: currentUrl.origin + '/' + business + '/',
    businessApiUrl: currentUrl.origin + '/api/' + business + '/',
    baseWebUrl: currentUrl.origin,
    baseApiUrl: currentUrl.origin + '/api/'
}
