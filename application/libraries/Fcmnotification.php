<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Fcmnotification
{
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->model('admin/Custom_model','custom_model');
        date_default_timezone_set('Asia/Kolkata');
    }
    
    function send_fcm_message_vender($user_id,$msg,$title='',$to_id='',$fname='')
    {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('admin_users','id,fcm_no,source',array('id'=>$user_id));
        
        // echo "<pre>";
        
        // print_r($check); die;
        
        if(!empty($check[0]['fcm_no']))
        {
            $fcmno = $check[0]['fcm_no'];
            $firebase = new Firebase();
            $push = new Push();
            $push->setTitle($title);
            $push->setMessage($msg);
            $push->setoid($to_id);
            $push->setfname($fname);
            $push->setUser($user_id);
            $json = $push->getPush();
            
            
            // $query = mysqli_query($conn,"SELECT iosToken FROM user_notify WHERE fcm_no = '$fcmno' AND iosToken !='' ");
            
            if( $check[0]['source'] == 'ios' || $check[0]['source'] == 'iOS'  )
            {
                $response = $firebase->sendToios($fcmno, $json);
                return $response;
            }
            else
            {
                //$json = json_encode($json);   
                $response = $firebase->send($fcmno, $json);
                return $response;
            }
            
        }
        else{
            return $check;
        }
    }
    
    function send_fcm_message_driver($user_id,$msg,$title='',$to_id='',$fname='')
    {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('users','id,fcm_no,source',array('id'=>$user_id));
        
        // echo "<pre>";
        
        // print_r($check); die;
        
        if(!empty($check[0]['fcm_no']))
        {
            $fcmno = $check[0]['fcm_no'];
            $firebase = new Firebase();
            $push = new Push();
            $push->setTitle($title);
            $push->setMessage($msg);
            $push->setoid($to_id);
            $push->setfname($fname);
            $push->setUser($user_id);
            $json = $push->getPush();
            
            
            // $query = mysqli_query($conn,"SELECT iosToken FROM user_notify WHERE fcm_no = '$fcmno' AND iosToken !='' ");
            
            if( $check[0]['source'] == 'ios' || $check[0]['source'] == 'iOS'  )
            {
                $response = $firebase->sendToios($fcmno, $json);
                return $response;
            }
            else
            {
                //$json = json_encode($json);   
                $response = $firebase->send($fcmno, $json);
                return $response;
            }
        }
        else{
            return $check;
        }
    }
    
    
    function send_fcm_message_user($user_id,$msg,$title='',$to_id='',$fname='')
     {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('users','*',array('id'=>$user_id));

        if(isset($check[0]['id']) && !empty($check[0]['fcm_no']))
        {
            $fcmno = $check[0]['fcm_no'];
            $firebase = new Firebase1();
            $push = new Push();
            $push->setTitle($title);
            $push->setMessage($msg);
            $push->setoid($to_id);
            $push->setfname($fname);
            $push->setUser($user_id);
            $json = $push->getPush();
            
            // $query = mysqli_query($conn,"SELECT iosToken FROM user_notify WHERE fcm_no = '$fcmno' AND iosToken !='' ");
            
            if( $check[0]['source'] == 'ios' || $check[0]['source'] == 'iOS'  )
            {
                $response = $firebase->sendToios($fcmno, $json);
                return $response;
            }
            else
            {
                //$json = json_encode($json);   
                $response = $firebase->send($fcmno, $json);
                return $response;
            }
            
        }
        else{
            return $check;
        }
    } 
    
    

    function send_fcm_message_driver_new_integrate($user_id,$msg,$title='',$image_url='',$action='',$action_destination= '',$topic = '')
     {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('admin_users','*',array('id'=>$user_id,'fcm_no!=' => ''));

        // echo "<pre>";
        // print_r($check);
        // die;

        if(isset($title))
        {
            $notification = new Firebase_driver();

            $title = $title;
            $message = isset($msg)?$msg:'';
            $imageUrl = isset($image_url)?$image_url:'';
            $action = isset($action)?$action:'';
            
            $actionDestination = isset($_POST['action_destination'])?$_POST['action_destination']:'';

            if($actionDestination ==''){
                $action = '';
            }

            $notification->setTitle($title);
            $notification->setMessage($message);
            $notification->setImage($imageUrl);
            $notification->setAction($action);
            $notification->setActionDestination($actionDestination);
            
            $firebase_token = @$check[0]['fcm_no'];

            $firebase_api = "AAAAZHYEess:APA91bH4LsxgmC1eSBz8-YQ2SpweLx6JN-Hn7WU1bU2gyzLJj8htSAvqbf8_530SVZHk2jhV4Of7RwcTZKXylH4JdD6RGfFomTbQYlqxv--NCMiH22kvwKdbTJMJMhl4NEV0H3eEfx21";
            
            $topic = $topic;
            
            $requestData = $notification->getNotificatin();
            
            if(!empty($topic)){
                $fields = array(
                    'to' => '/topics/' . $topic,
                    'data' => $requestData,
                );
                
            }else{
                
                $fields = array(
                    'to' => $firebase_token,
                    'data' => $requestData,
                );
            }


            // Set POST variables
            $url = 'https://fcm.googleapis.com/fcm/send';

            $headers = array(
                'Authorization: key=' . $firebase_api,
                'Content-Type: application/json'
            );
            
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarily
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if($result === FALSE){
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
            
            // echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
            // echo json_encode($fields,JSON_PRETTY_PRINT);
            // echo '</pre></p><h3>Response </h3><p><pre>';
            // echo $result;
            // echo '</pre></p>';
            // die;
        }
    }


    function send_fcm_message_vender_new_integrate($user_id,$msg,$title='',$image_url='',$action='',$action_destination= '',$topic = '')
     {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('admin_users','*',array('id'=>$user_id,'fcm_no!=' => ''));

        // echo "<pre>";
        // print_r($check);
        // die;

        if(isset($title))
        {
            $notification = new Firebase_driver();

            $title = $title;
            $message = isset($msg)?$msg:'';
            $imageUrl = isset($image_url)?$image_url:'';
            $action = isset($action)?$action:'';
            
            $actionDestination = isset($_POST['action_destination'])?$_POST['action_destination']:'';

            if($actionDestination ==''){
                $action = '';
            }

            $notification->setTitle($title);
            $notification->setMessage($message);
            $notification->setImage($imageUrl);
            $notification->setAction($action);
            $notification->setActionDestination($actionDestination);
            
            $firebase_token = @$check[0]['fcm_no'];

            $firebase_api = "AAAAZHYEess:APA91bH4LsxgmC1eSBz8-YQ2SpweLx6JN-Hn7WU1bU2gyzLJj8htSAvqbf8_530SVZHk2jhV4Of7RwcTZKXylH4JdD6RGfFomTbQYlqxv--NCMiH22kvwKdbTJMJMhl4NEV0H3eEfx21";
            
            $topic = $topic;
            
            $requestData = $notification->getNotificatin();
            
            if(!empty($topic)){
                $fields = array(
                    'to' => '/topics/' . $topic,
                    'data' => $requestData,
                );
                
            }else{
                
                $fields = array(
                    'to' => $firebase_token,
                    'data' => $requestData,
                );
            }


            // Set POST variables
            $url = 'https://fcm.googleapis.com/fcm/send';

            $headers = array(
                'Authorization: key=' . $firebase_api,
                'Content-Type: application/json'
            );
            
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarily
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if($result === FALSE){
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
            
            // echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
            // echo json_encode($fields,JSON_PRETTY_PRINT);
            // echo '</pre></p><h3>Response </h3><p><pre>';
            // echo $result;
            // echo '</pre></p>';
            // die;
        }
    }


    function send_fcm_message_user_new_integrate($user_id,$msg,$title='',$image_url='',$action='',$action_destination= '',$topic = '')
     {
        // $check = User::where('id', $user_id)->get();
        // get user id
        $check = $this->CI->custom_model->my_where('users','*',array('id'=>$user_id,'fcm_no!=' => ''));

        // echo "<pre>";
        // print_r($user_id);
        // print_r($check);
        // die;

        if(isset($title))
        {
            $notification = new Firebase_user();

            $title = $title;
            $message = isset($msg)?$msg:'';
            $imageUrl = isset($image_url)?$image_url:'';
            $action = isset($action)?$action:'';
            
            $actionDestination = isset($_POST['action_destination'])?$_POST['action_destination']:'';

            if($actionDestination ==''){
                $action = '';
            }

            $notification->setTitle($title);
            $notification->setMessage($message);
            $notification->setImage($imageUrl);
            $notification->setAction($action);
            $notification->setActionDestination($actionDestination);
            
            $firebase_token = @$check[0]['fcm_no'];

            $firebase_api = "AAAAEeD-tKE:APA91bE48jhgB1t590jy5gja193BVWPHBt1oUvCCG6i3qDJiaXAdlGcvFMTcSCtYqYJSaA7uiEsqockYSUDxmEgeinZl9cPlI9GjITcgrf63TZ3WLYYVlXFYmpK_t9XOfQHtc6tFEoYi";
            
            $topic = $topic;
            
            $requestData = $notification->getNotificatin();
            
            if(!empty($topic)){
                $fields = array(
                    'to' => '/topics/' . $topic,
                    'data' => $requestData,
                );
                
            }else{


                $source = @$check[0]['source'];

                if ($source == 'android') 
                {
                    $fields = array(
                        'to' => $firebase_token,
                        'data' => $requestData,
                    );
                }
                else
                {
                    $fields = array(
                        'to' => $firebase_token,
                        'data' => $requestData,
                    );
                }              
               
            }


            // Set POST variables
            $url = 'https://fcm.googleapis.com/fcm/send';

            $headers = array(
                'Authorization: key=' . $firebase_api,
                'Content-Type: application/json'
            );
            
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarily
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if($result === FALSE){
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
            
            // echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
            // echo json_encode($fields,JSON_PRETTY_PRINT);
            // echo '</pre></p><h3>Response </h3><p><pre>';
            // echo $result;
            // echo '</pre></p>';
            // die;
        }
    }










    public function send_festival_notification_to_vender($user_id , $title ,$message, $image = '')
    {
            $user_id    = $user_id;
            $message    = $message;
            $title      = $title;
            if ($image)
            {
                $to_id      = base_url('/assets/admin/festival_notification/').$image;
            }else{
                $to_id = '';
            }
            
            $this->send_fcm_message_vender_new_integrate($user_id, $message, $title,$to_id);

    }

    public function send_festival_notification_to_driver($user_id , $title ,$message, $image = '')
    {
            $user_id    = $user_id;
            $message    = $message;
            $title      = $title;
            if ($image)
            {
                $to_id      = base_url('/assets/admin/festival_notification/').$image;
            }else{
                $to_id = '';
            }
            
            $this->send_fcm_message_driver_new_integrate($user_id, $message, $title,$to_id);

    }

    public function send_festival_notification_to_user($user_id , $title ,$message,$image = '')
    {
            $user_id    = $user_id;
            $message    = $message;
            $title      = $title;

            if ($image)
            {
                $to_id      = base_url('/assets/admin/festival_notification/').$image;
            }
            else{
                $to_id = '';
            }
            // $this->send_fcm_message_api($user_id, $message, $title);

            // print_r($to_id);
            // die;

            $this->send_fcm_message_user_new_integrate($user_id, $message, $title,$to_id);

    }
    
    public function send_order_delivery_message_user($user_id )
    {
            $user_id    = $user_id;
            $title      = "Order Delivered";
            $message    = "Your order has been delivered. Bon Appetit!";
            $to_id      = '';
            // $this->send_fcm_message_api($user_id, $message, $title);
            $this->send_fcm_message_user_new_integrate($user_id, $message, $title);

    }
    
    public function order_notification_to_user($user_id )
    {
            $user_id    = $user_id; 
            $title      = "Order Accepted ";
            $message    = "Your order comes within a 30-40 minutes. Bon Appetit!";
            $to_id      = '';
            // $this->send_fcm_message_api($user_id, $message, $title);
            $this->send_fcm_message_user_new_integrate($user_id, $message, $title);
    }

    public function notification_to_user_for_order_accept($user_id )
    {
            $user_id    = $user_id; 
            $title      = "Order Accepted ";
            $message    = "Your order comes within a 30-40 minutes. Bon Appetit!";
            $to_id      = '';
            // $this->send_fcm_message_api($user_id, $message, $title);
            $this->send_fcm_message_user_new_integrate($user_id, $message, $title);

    }

    public function notification_to_new_user($user_name='')
    {

        if ($user_name)
        {
            $u_details = $this->CI->custom_model->get_data_array("SELECT * FROM users WHERE id IN ('2', '9', '17','16','14','12') ");

            if (!empty($u_details)) 
            {
                foreach ($u_details as $key => $value) {
                    $user_id = $value['id'];
                    $title     = "New user is Registerd";
                    $message    = ''.$user_name ;
                    $this->send_fcm_message_user_new_integrate($user_id, $message, $title);
                }
            }
        }
        else
        {
            $u_details = $this->CI->custom_model->get_data_array("SELECT * FROM users WHERE id IN ('12', '16', '10','6','14') ");

            if (!empty($u_details)) 
            {
                foreach ($u_details as $key => $value) {
                    $user_id = $value['id'];
                    $title     = "New order is Received";
                    $message    = 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.' ;
                    $this->send_fcm_message_user_new_integrate($user_id, $message, $title);
                }
            }

        }    
    }


    public function notification_to_new_orderr($user_id)
    {
        if (!empty($user_id)) 
        {
                $duser_id = $user_id;
                $title     = "New order is Received";
                $message    = 'New order is Received' ;
                $this->send_fcm_message_driver_new_integrate($duser_id, $message, $title);
        } 
    }


    public function notification_to_new_order_to_vender($vender_id)
    {
        if (!empty($vender_id)) 
        {
                $vender_id = $vender_id;
                $title     = "New order is Received to vender ";
                $message    = 'New order is Received to vender' ;
                $this->send_fcm_message_vender_new_integrate($vender_id, $message, $title);
        } 
    }
    
    public function new_order_notification_on_off($user_id)
    {

        $udetails = $this->CI->custom_model->get_data_array("SELECT * FROM notification_on_off_message WHERE id = '1' ");        
        $user_id        = $user_id;
        $title          = $udetails[0]['title'];
        $message        = $udetails[0]['message'];
        $this->send_fcm_message_user_new_integrate($user_id, $message, $title);
    }
    
    
    public function notification_to_new_orderr_to_vender($vender_id )
    {
            $user_id    = $vender_id;
            $title    = "New Order is on the way in Chicken farm !!";
            $message  = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum ... The first line of Lorem Ipsum  !!";
            $to_id      = '';
            $this->send_fcm_message_vender_new_integrate($user_id, $message, $title);

    }
    

}