<?php
	
	
	$username = $_POST['uname'];
    $password = $_POST['psw'];
    
	$ldaprdn  = 'dc=example,dc=com';
    $ldappass = null;  

    $ldapconn = ldap_connect('ldap.forumsys.com')
            or die("Could not connect to LDAP server.");
	
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

    if ($ldapconn) {
		
        $ldapbind = ldap_bind($ldapconn);

		if ($ldapbind) {
		    $dn="uid=".$username;
		   	$result= ldap_search( $ldapconn,$ldaprdn,$dn) or exit("unable to search");
           	$entries = ldap_get_entries($ldapconn,$result);
		  
			if(isset($_POST['uname'])){
			
				if ($bind=ldap_bind( $ldapconn,$entries[0]["dn"], $password)) {
			  		echo("Login correct");
			  		header("Location: welcome.html");
			  		exit();
			  
				} else {
					echo "Login Failed: Please check your username or password";
				}
		
		
			}

   		}
	}
?>