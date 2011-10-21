<?php

class ldapauthComponent extends Object {  

  //simpleLdap.php---some functions we got from Don.    He got them from MRBS (Meeting Room Booking System)
  // We adapted them.  Kthxbye  (Phill C.)


/* authValidateUser($user, $pass)
 * 
 * Checks if the specified username/password pair are valid
 * 
 * $user  - The user name
 * $pass  - The password
 * 
 * Returns:
 *   0        - The pair are invalid or do not exist
 *   non-zero - The pair are valid
 */
function authValidateUser($user, $pass)
{

/*
  global $auth;
  global $ldap_host;
  global $ldap_port;
  global $ldap_v3;
  global $ldap_tls;
  global $ldap_base_dn;
  global $ldap_user_attrib;
  global $ldap_filter;
  global $ldap_dn_search_attrib;
  global $ldap_dn_search_dn;
  global $ldap_dn_search_password;
*/
  $ldap_host = "ldaps://web.cs.ucsb.edu";
  $ldap_port;
  $ldap_v3 = true;
  $ldap_tls = false;
  $ldap_base_dn ="dc=engr,dc=ucsb,dc=edu";


  $ldap_user_attrib = "uid";

  // See if the expiration date for this account is greater than "noon UTC" today (Z = UTC, GMT)
  $coeNow = date('Y m d');
  list($year, $month, $day) = explode(' ', $coeNow);
  $ldap_filter = "coeexpirationdate>=" . $year . $month . $day . "120000Z";


  $ldap_dn_search_attrib = "uid";
  $ldap_dn_search_dn = "uid=nssldap,ou=people,dc=engr,dc=ucsb,dc=edu";
  $ldap_dn_search_password = "buMps3tSp1ke";



  if (!function_exists("ldap_connect"))
  {
    die("<hr><p><b>ERROR: PHP's 'ldap' extension is not installed/enabled. ".
        "Please check your MRBS and web server configuration.</b></p><hr>\n");
  }

  $all_ldap_base_dn     = array();
  $all_ldap_user_attrib = array();

  // Check if we do not have a username/password
  // User can always bind to LDAP anonymously with empty password,
  // therefore we need to block empty password here...
  if (!isset($user) || !isset($pass) || strlen($pass)==0)
  {
    return 0;
  }

  // Check that if there is an array of hosts and an array of ports
  // then the number of each must be the same or the authenication
  // is forced to fail.
  if (is_array( $ldap_base_dn ) && is_array( $ldap_user_attrib ) &&
      count($ldap_user_attrib) != count($ldap_base_dn) )
  {
    return 0;
  }

  // Transfer the based dn(s) to an new value to ensure that
  // an array is always used.
  // If a single value is passed then turn it into an array
  if (is_array( $ldap_base_dn ) )
  {
    $all_ldap_base_dn = $ldap_base_dn;
  }
  else
  {
    $all_ldap_base_dn = array($ldap_base_dn);
  }

  // Transfer the array of user attributes to a new value.
  // Create an array of the user attributes to match the number of
  // base dn's if a single user attribute has been passed.
  if (is_array( $ldap_user_attrib ) )
  {
    $all_ldap_user_attrib = $ldap_user_attrib;
  }
  else
  {
    while ( each($all_ldap_base_dn ) )
    {
      $all_ldap_user_attrib[] = $ldap_user_attrib;
    }
  }

  // establish ldap connection
  // the '@' suppresses errors
  if (isset($ldap_port))
  {
    $ldap = @ldap_connect($ldap_host, $ldap_port);
  }
  else
  {
    $ldap = @ldap_connect($ldap_host);
  }

  // Check that connection was established
  if ($ldap)
  {
    if ($ldap_v3)
    {
      ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    }
    if ($ldap_tls)
    {
      ldap_start_tls($ldap);
    }
    // now process all base dn's until authentication is achieved
    // or fail
    foreach ( $all_ldap_base_dn as $idx => $base_dn)
    {
      if (isset($ldap_dn_search_attrib))
      {
        if (isset($ldap_dn_search_dn) &&
            isset($ldap_dn_search_password))
        {
          // Bind with DN and password
          $res = @ldap_bind($ldap, $ldap_dn_search_dn,
                            $ldap_dn_search_password);
        }
        else
        {
          // Anonymous bind
          $res = @ldap_bind($ldap);
        }

        if ($res)
        {
          $res = @ldap_search($ldap,
                              $base_dn,
                              "(". $ldap_dn_search_attrib ."=$user)");

          if (@ldap_count_entries($ldap, $res) == 1)
          {
            $entries = ldap_get_entries($ldap, $res);
            $dn = $entries[0]["dn"];
            $user_search = "distinguishedName=" . $dn;
          }
        }
      }
      else
      {
        // construct dn for user
        $user_search = $all_ldap_user_attrib[$idx] . "=" . $user;
        $dn = $user_search . "," . $base_dn;
      }
      // try an authenticated bind
      // use this to confirm that the user/password pair
      if ($dn && @ldap_bind($ldap, $dn, $pass))
      {
        // however if there is a filter check that the
        // user is part of the group defined by the filter
        if (! $ldap_filter)
        {
          @ldap_unbind($ldap);
          return 1;
        }
        else
        {
          $res = ldap_search($ldap,
                              $base_dn,
                              //"(&($user_search)($ldap_filter))",
                              // The following filter looks like "(&(uid=dvoita)(coeexpirationdate>=<today's date>))"
                              "(&($ldap_dn_search_attrib=$user)($ldap_filter))",
                              array()
                             );
          if (ldap_count_entries($ldap, $res) > 0)
          {
            ldap_unbind($ldap);
            return 1;
          }
        }
      }
    }
    @ldap_unbind($ldap);
  }
  // return failure if no connection is established
  return 0;
} // end of function authValidateUser



} // end of class


?>