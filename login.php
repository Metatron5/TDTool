<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>login for TDTool</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/mobile.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/mobile-login.css">
    </head>
    <body>  
        <div id="login-wrapper">
            <header id="login-header">
                <div id="login-logoarea">
                    <img id="login-logo" src="images/logo.png" alt="">
                </div>
                <div id="login-titlearea">
                    <h1 id="login-title">TDTool</h1>
                </div>
            </header>
            <main id="login-main">
                <div id="login-loginarea">
                    <form id="login-form-login" method="post" action="check.php">
                        <input id="login-input-username" name="username" type="text" placeholder="username" required/>
                        <input id="login-input-password" name="password" type="password" placeholder="password" required/>
                        <input id="login-btn-login" type="submit" value="Login"/>
                    </form>
                </div>
            </main>

            <footer id="login-footer">
                <div id="madebyarea">
                    <h6 id="madeby">made by Marcus Heri</h6>
                </div>
            </footer>
        </div>
    </body>
</html>