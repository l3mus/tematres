var plugins = (function(){
    var initModule = function(container, button, is_logged_in){
        plugins.userMenu.initModule(container, button, is_logged_in);
    };
    return {initModule : initModule};
}());