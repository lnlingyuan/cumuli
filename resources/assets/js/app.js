// TODO 请不要随意调整顺序
window.$ = window.jQuery = require('jquery');
window.moment = require('moment');

// 加载第三方包
require('jquery.cookie');

// 加载项目模块
$.cumuli = {variable: {}, config: {}};
require('./cumuli/easyui');
require('./cumuli/config');
require('./cumuli/event');
require('./cumuli/method');
require('./cumuli/setup');
