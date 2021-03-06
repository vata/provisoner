<?php
/**
 * Provisioner evolution gateway controller
 *
 * @category  Provisioning
 * @author    S. Hamblett <steve.hamblett@linux.com>
 * @copyright 2009 S. Hamblett
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package provisioner
 */

/* Check access */
define('IN_REVO_GATEWAY_CONNECTOR', "true");

require_once 'common/security.php';
require_once 'common/support.php';

$scriptProperties = array();

/* Ok, check the input parameters */
$entity = $_GET['entity'];
if ( $entity == '' ) {

    echo "Revo Gateway API error - no entity supplied";
    exit;
}

$action = $_GET['action'];
if ( $action == '' ) {

    echo "Revo Gateway API error - no action supplied";
    exit;
}

/* Call the correct backend processor */
switch ( $entity) {

    case 'resources' :

        /* Get all call for full site import */
        if ( $action == 'getall' ) {

           include "resources/getall.php";
            break;
        }

        /* Otherwise single resource or tree */
        $scriptProperties['id'] = $_GET['id'];

        if ( $action == 'getnodes' ) {
          
            $scriptProperties['type'] = $_GET['type'];
            $scriptProperties['stringLiterals'] = $_GET['stringLiterals'];
            include "resources/getnodes.php";

        }

        if ( $action == 'get' ) {

            include "resources/get.php";
        }

        break;

    case 'elements' :

        $scriptProperties['type'] = $_GET['type'];
        
        /* Get all call for full site import */
        if ( $action == 'getall' ) {

           include "elements/getall.php";
           break;
        }

        /* Get all TV data call for full site import */
        if ( $action == 'getalltvdata' ) {

           include "elements/getalltvdata.php";
           break;
        }

        /* Get all plugin event call for full site import */
        if ( $action == 'getallpluginevents' ) {

           include "elements/getallpluginevents.php";
           break;
        }

        $scriptProperties['id'] = $_GET['id'];
        

        if ( $action == 'getnodes' ) {

           
            $scriptProperties['stringLiterals'] = $_GET['stringLiterals'];
            include "elements/getnodes.php";

        }

        if ( $action == 'get' ) {

            include "elements/get.php";

        }

        break;

    case 'files' :
      

        if ( $action == 'getnodes' ) {

             $scriptProperties['id'] = $_GET['id'];
            include "files/getlist.php";
        }

        if ( $action == 'getfiles' ) {

            $scriptProperties['dir'] = $_GET['dir'];
            include "files/getfiles.php";
        }

        if ( $action == 'get' ) {

            $scriptProperties['file'] = $_GET['file'];
            include "files/get.php";
        }

        break;

    case 'users' :

        if ( $action == 'getusers' ) {

            $scriptProperties['username'] = $_GET['username'];
            $scriptProperties['start'] = $_GET['start'];
            $scriptProperties['limit'] = $_GET['limit'];
            include "users/getlist.php";
        }

        if ( $action == 'get' ) {

            $scriptProperties['id'] = $_GET['id'];
            $scriptProperties['type'] = $_GET['type'];
            include "users/get.php";
        }
        
        break;

    case 'keywords' :

        /* Get all call for full site import */
        if ( $action == 'getall' ) {

           include "resources/getallkeywords.php";
        }
        
        break;

    case 'metatags' :

        /* Get all call for full site import */
        if ( $action == 'getall' ) {

           include "resources/getallmetatags.php";
        }

        break;

    case 'docgroups' :

        /* Get all call for full site import */
        if ( $action == 'getall' ) {

           include "resources/getalldocgroups.php";
        }

        break;

    default:

        echo "Revo Gateway API error - no such entity as $entity";
}


