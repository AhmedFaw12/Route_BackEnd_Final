<?php

/*

    What is HTTP?
    -The Hypertext Transfer Protocol (HTTP) is designed to enable communications between clients and servers.

    -HTTP works as a request-response protocol between a client and server.

    -Example: A client (browser) sends an HTTP request to the server; then the server returns a response to the client. The response contains status information about the request and may also contain the requested content.
    HTTP Methods:
        -GET
        -POST        


    -server removes all data in its memory after server respond to the client, so server does not save any state variable
    - if data is important , then server will save it in database or file

    - so I as a developer  must manage state of variables that i need not all variables like (login info so the user will not enter his login info every time during his session ) 

    types of Managing variable state : 
    1)server side managing variable state : saving data at server
        - session (in server memory)
        - database
        - file
    2)client side managing variable state: save data at client with response and send it to the server again with request
        1)url - query string - get
        2)hidden
        2)cookie(memory-file)

     -note :php(or any server side language) can write at the client in these three places only(get , hidden, cookie)
    

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    -in form if i didnt determine the name of page to go to , it will request itself

    -input tag : i should write name attribute 
    -i should have another input with type="submit" attribute to submit form
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    Form Methods :
    1)get method:
        1) client will request the login.php page from server
        2) the server will send me the form(html)(login.html) in the response
        3) then then the client will send name and age (data) in the url (in the request) to the server to (home.php)
        4) the server will save these data in superGlobal associative array called _GET
        
        $_GET["name"]
        $_GET["age"]
    
        ?name=ahmed&age=25 is called query string
        
    notes on get Method:
    - Each time you want to reach a resource on the Web, the browser sends a request to a URL.
    
    -An HTTP request consists of two parts: a header that contains a set of global metadata about the browser's capabilities, and a body that can contain information necessary for the server to process the specific request.
    
    -The GET method is the method used by the browser to ask the server to send back a given resource: "Hey server, I want to get this resource." In this case, the browser sends an empty body. Because the body is empty, if a form is sent using this method the data sent to the server is appended to the URL.

    -the query string (name/value pairs) is sent in the URL of a GET request

    -The form information is visible in the URL

    -get method is not secured because data is send through the url , and i can change what is written in the url by hand

    -Since the data sent by the GET method are displayed in the URL, it is possible to bookmark the page

    -data sent through url is limited (we can send up to 1KB data only), Limited amount of information is sent. It is less than 1500 characters.
    
    -GET requests remain in the browser history

    -get method is the default method in the form 
    
    -helps to 
    when to use get method :
    - always used in search pages 
    -Helps to send non-sensitive data
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    2) post method: 
    -The POST method is a little different. It's the method the browser uses to talk to the server when asking for a response that takes into account the data provided in the body of the HTTP request: "Hey server, take a look at this data and send me back an appropriate result." If a form is sent using this method, the data is appended to the body of the HTTP request.


    -The data sent to the server with POST is stored in the request body of the HTTP request

    -The form information is not visible in the URL
    -Unlimited amount of information is sent.(one can send text data as well as binary data(word documents,images) and uploading a file using POST.)
    -More secure.

    -Since the data sent by the POST method is not visible in the URL, so it is not possible to bookmark the page with specific query.

    -PHP provide another superglobal variable $_POST to access all the information sent via post

    when to use:
    -Helps to send sensitive data (passwords), binary data (word documents, images)and uploading files


    /////////////////////////////////////////////////////////////////////////////////////////////////////
    Notes:
    -we can send get and post methods at same time by using post method and writing in the url at same time:

    <form action= "home.php?id=10&salary=777" method = "POST">
        ....................
    </form>

    - if i send same variables but with different values using get and post at same time : it will take value of variable of post method because post is more secure
////////////////////////////////////////////////////////////
    PHP Global Variables - Superglobals:
    -are built-in variables that are always available in all scopes

    -Some predefined variables in PHP are "superglobals", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do anything special.

        $_GET
        $_POST
        $_REQUEST
        $GLOBALS
        $_SERVER
        $_FILES
        $_ENV
        $_COOKIE
        $_SESSION


    1) $_GET[] : 
        -PHP $_GET is a PHP super global variable(associative array) which is used to collect form data after submitting an HTML form with method="get". 

        -$_GET can also collect data sent in the URL.

    2)$_POST[] :
        -PHP $_POST is a PHP super global variable(associative array) which is used to collect form data after submitting an HTML form with method="post". $_POST is also widely used to pass variables.

    3)$_REQUEST[] :
        -PHP provides another superglobal variable $_REQUEST that contains the values of both the $_GET and $_POST variables as well as the values of the $_COOKIE superglobal variable.
    
    4)$GLOBALS[] :
        -GLOBALS is a PHP super global variable which is used to access global variables(created by user, built-in) and access the other superglobal variables($_GET, $_POST, $_SERVER, $_COOKIE,)  from anywhere in the PHP script (also from within functions or methods).

        -PHP stores all global variables in an array called $GLOBALS[index]. The index holds the name of the variable.

    5)$_COOKIE[] : superglobal variable to retreive the value of cookie.
    
    6)$_SESSION[] :superglobal variable(associative array) to set the value of session
	
	7)$_SERVER[] associative superglobal_array which holds information about headers, paths, and script locations.
                    -  some of the elements in $_SERVER:
                        -$_SERVER['PHP_SELF']	:Returns the filename of the currently executing script(home.php, ...)

                        -$_SERVER['SERVER_ADDR'] : Returns the IP address of the host server  

                        -'REQUEST_URI' : The URI which was given in order to access this page; for instance, '/index.html'.

    /////////////////////////////////////////////////////////////////////////////////////////////////
    managing state variables :

    1)url-get-query string:
        -after the server sent home.php page to the client , all of the post , get variables(name, age ,....) are deleted from the server
        - so if the home.php page has a link to another page (page2.php) , demo.php will not see any variables as they are deleted from the server
        , so we must manage the state of our variables
        - the server should send(save) (post or get) variables to other pages(page2.php) in the url when we click on the link tag

        -if we have 1000 pages , i have to send variables through the url 1000 times , so this way is not good
        - this way may be good if we only have 2 or 3 pages atmost
        -not secure (we can change values from inspect)
    #######################################################
    2)hidden:
    -instead of sending variables in the url , we can send them in the form by using input type hidden 
    <input type = "hidden">

    - input type hidden has no ui
    -if we have 1000 pages , i have to send variables using form input hidden  1000 times from page to page , so this way is also not good 
    
    -not secure (we can change values from inspect)
    #######################################################
    3)cookies(memory-file):
    -if i have multiple pages, then we will use cookies
    -server gives data to the browser during response 

    -PHP cookie is a small piece of information(key , value pairs) which is stored at client browser. It is used to recognize the user.

    -Cookie is a small piece of information stored as a file in the user's browser by the web server.
    
    -Cookie is created at server side and saved to client browser. Each time when client sends request to the server, cookie is embedded with request. Such way, cookie can be received at the server side.

    -There are three steps involved in identifying returning users:

        -Server script sends a set of cookies to the browser. For example name, age, or identification number etc.
        
        -Browser stores this information on local machine for future use.
        
        -When next time browser sends any request to web server then it sends those cookies information to the server and server uses that information to identify the user.
        
        
    -Once created, cookie is sent to the web server as header information with every HTTP request
        
    -cookie data is shared among all php(server side) pages not html pages
        
    -cookies are related to the browser opened (if I logged in facebook from chrome , firefox will not see the cookies, and no account is opened on firefox).
        
    
    
    types of cookies:
    1)session cookies:This type of cookies are temporary and are expire as soon as the session ends or the browser is closed. (it is stored in RAM memory).
    
    2)Persistent(permanent) Cookie: To make a cookie persistent we must provide it with an expiration time. Then the cookie will only expire after the given expiration time, until then it will be a valid cookie.
    
    -cookie storage capacity:
        - a cookie has a (1KB)1024 byte size limit
    
    when to use cookies:
        1)To store user information like when he/she visited, what pages were visited on the website etc, so that next time the user visits your website you can provide a better user experience.

        2)To store basic website specific information to know this is not the first visit of user.
        
        3)You can use cookies to store number of visits or view counter.

        4) when i login to (example:facebook ) , it sends me a cookie with my login info , so when go to facebook again , it will be already logged in .

        5)styling(when I enter a website that has multiple styles , and I chose  for example dark mode , it will know my choice)
        
        6) remember_me checkbox
    -PHP Cookie must be used before <html> tag.

    -$_COOKIE[] : superglobal variable to retreive the value of cookie.
    -we should use isset()/empty() function to find out if the cookie is set or not.
    
    -setcookie(name, value(optional), expire(optional), path(optional), domain(optional), secure(optional)): Create/set a cookie , once a cookie is set you can access it by $_COOKIE superglobal variable.

    -i can read the cookie set at any page (server side) even if same page where the cookie is set.

    parameter of setcookie():
        - name : required , name of cookie

        - value : specifies value of cookie ,this value is retrieved through $_COOKIE['cookiename']

        -expire : optional ,specifes when cookie expires (by default it will expire when session end(browser closes))
        , time() function ==> gets the current time in numbers 
        ,The value: time()+(60 * 60 * 24)*30, will set the cookie to expire in 30 days 
        ==> 60 * 60 * 24 * 7 : gives 1 week
    
    -delete cookie :To delete/remove a cookie, we need to expire the cookie, which can be done by updating the cookie using the setcookie() function with expiration date in past,

    setcookie("user_name", null, time() - 3600);


    -not secure : user or browsers can remove/blocke cookies by hand so no data is saved at browser
///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    -client side state management : data is sent forward and backward(during request ,response) over and over
    so it causes network traffic
    
    server side state management:
    1)Sessions:

    -  way to make data accessible across the various pages of an entire website 

    -A session creates a file in a temporary directory on the server where registered session variables and their values are stored. This data will be available to all pages on the site during that visit.

    When a session is started following things happen :
        1)
        -PHP first creates a unique identifier(id) for that particular session session which is a random string of 32 hexadecimal numbers 
        
        -the file and id created is specific for each browser(chrome is different from microsoft edge different from firefox ,...........)

        2)
        -then server creates a cookie called PHPSESSID is automatically sent to the user's computer(browser) to store unique session identification string.

        - if browser disabled cookies , then the server sends the session id through URL to the browser.

        3)then A file is automatically created on the server in the designated(معين) temporary directory and bears(يحمل) the name of the unique identifier prefixed by sess_

    -When a PHP script wants to retrieve the value from a session variable, PHP automatically gets the unique session identifier(id) string from the PHPSESSID cookie and then looks in its temporary directory for the file bearing that name and a validation can be done by comparing both values.

    -whenever same browser makes another request ,it sends the id it received to the user.
    
    
    -when does a session ends:
        -By default, if your session variables are not linked to any cookies , the session will end when the browser is closed .
        
        -if your session variables come from cookies , the session will end after time specified in the cookie.

    -session functions:
        1)session_start() :A  PHP session is easily started by making a call to the session_start() function

        -The session_start() function must be the very first thing in your document. Before any HTML tags. and must be the first code in php

        - we must write session start() before setting or reading from $_SESSION[] array
        
        2)session_unset() :removes all session variables but keeps session id

        3)session_destroy() : destroy the session with all session variables
        
        4)session_id() : The session_id() function is used to set or retrieve a custom id to the current.
        example : echo session_id(); //retreive id


    session Advantages:
    1)private session for every client(browser).
    2)more secure (data is stored at server)
    3)does not cause network traffic
    4)unlimited storage but we should store only what we need to stop draining(استنزاف) of server memory 

    destroy php session:
    -remove single variable : use unset($_SESSION["var_name"]) , this will delete key with value
        or
    -$_SESSION["var_name"] = null; , this will delete value but keep the key
        or
    - session_unset() :removes all session variables but keeps session id
        or 
    -session_destroy() : to destroy whole session with id
    /////////////////////////////////////////////////////////////////////
    2)files (permenant)
    */

    // echo time();// 1645448465