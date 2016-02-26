plugins.userMenu = (function(){
    var configMap = {login_html : String() +
                    '<div id="login-form"><form method="post" id="loginForm">' +
                        '<ul>' +
                            '<li>' +
    '                           <div class="flex-row">' +
    '                               <div class="row-label">' +
    '                                   <label for="username"><span class="glyphicon glyphicon-user label-span"></span></label>' +
    '                               </div>' +
    '                               <div class="row-input">' +
    '                                   <input id="username" name="username" class="plugin-input" type="email" placeholder="Username" required/>' +
    '                               </div>' +
    '                           </div>' +
    '                       </li>' +
                            '<li>' +
    '                           <div class="flex-row">' +
    '                               <div class="row-label">' +
    '                                   <label for="password"><span class="glyphicon glyphicon-lock label-span"></span></label>' +
    '                               </div>' +
    '                               <div class="row-input">' +
    '                                   <input id="password" name="password" class="plugin-input" type="password" placeholder="Password" required/>' +
    '                               </div>' +
    '                           </div>' +
    '                       </li>' +
                            '<li><div class="flex-row login-submit"><input id="login-submit" type="submit" value="Login"></div></li>' +
                        '</ul>' +
                    '</form></div>',
                     logged_html : '<div style="color:#000;">Logged in already!</div>',
                     logout_html : '',
                     menu_extend_time : 800,
                     menu_retract_time : 500,
                     menu_ht_extended : 220,
                     menu_ht_retracted : 0,
                     menu_extended_label : 'Click to retract',
                     menu_retracted_label : 'Click to extend'
    };
    var stateMap = {$container : null,
                    button : null,
                    is_logged_in : null,
                    is_retracted : true
    };
    var jqueryMap = {};

    var setJQueryMap = function(){
        var $container = stateMap.$container;
        var button = stateMap.button;
        jqueryMap = {$container : $container,
                     button : button
        };
    };
    var toggleMenu = function(do_extend){
        var menu_ht_px = jqueryMap.$container.height();
        var is_menu_open = menu_ht_px === (configMap.menu_ht_extended - 2); //subtract 2 because of the border
        var is_menu_closed = menu_ht_px === configMap.menu_ht_retracted;
        var is_sliding = !is_menu_open && !is_menu_closed;

        if(is_sliding){
            return false;
        }
        if(do_extend){
            jqueryMap.$container.animate({height : configMap.menu_ht_extended}, configMap.menu_extend_time, function(){
                jqueryMap.button.attr('title', configMap.menu_extended_label);
                stateMap.is_retracted = false;
                if(stateMap.is_logged_in === 'Login'){
                    jqueryMap.$container.html(configMap.login_html);
                }else{
                    jqueryMap.$container.html(configMap.logged_html);
                }
            });
            return true;
        }
        jqueryMap.$container.animate({height : configMap.menu_ht_retracted}, configMap.menu_retract_time, function(){
            jqueryMap.button.attr('title', configMap.menu_retracted_label);
            stateMap.is_retracted = true;
            jqueryMap.$container.html('');
        });
        return true;
    };
    var onClick = function(event){
        toggleMenu(stateMap.is_retracted);
        return false;
    };
    var login = function(){
        $(document).on("submit", "#loginForm", function(){
            //alert('loginForm Test!@!');
            //var sss = $("#id_password").val();
            //alert(sss);
            $.ajax({
                type: "POST",
                url: "../plugins/tempFunctionality/account.php",
                data: {
                    username: $("#username").val(),
                    password: $("#password").val()
                    //id_correo_electronico: $("#id_correo_electronico").val(),
                    //id_password: $("#id_password").val()
                },
                success: function(response){
                    alert(response);
                    //if(response === 'redirect'){
                    //    window.location.href = "index.php";
                    //}
                }
            });
            return false;
        });
    };
    var initModule = function($container, button, is_logged_in){
        stateMap.$container = $container;
        stateMap.button = button;
        stateMap.is_logged_in = is_logged_in;
        //$container.html(configMap.main_html);
        setJQueryMap();
        //setTimeout(function(){toggleMenu(true)}, 3000);
        //setTimeout(function(){toggleMenu(false)}, 8000);
        stateMap.is_retracted = true;
        jqueryMap.button.attr('title', configMap.menu_retracted_label).click(onClick);
        login();
    };
    return {initModule : initModule};
}());