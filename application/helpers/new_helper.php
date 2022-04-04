<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_crypt'))
{
    function my_crypt($string, $action = 'e' )
    {
        $secret_key = 'akshar_furniture_key';
	    $secret_iv = 'akshar_furniture_iv';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
    }
}

if ( ! function_exists('auth'))
{
    function auth()
    {
        $CI =& get_instance();
        if (empty($CI->session->userdata('role'))) {
		    return redirect('admin/login');
		}
    }
}

if ( ! function_exists('login'))
{
    function login()
    {
        $CI =& get_instance();
        if (!empty($CI->session->userdata('role'))) {
		    return redirect('admin');
		}
    }
}

if ( ! function_exists('re'))
{
    function re($array='')
    {
        $CI =& get_instance();
        echo "<pre>";
        print_r($array);
        exit;
    }
}

if ( ! function_exists('flashMsg'))
{
    function flashMsg($success,$succmsg,$failmsg,$redirect)
    {
        $CI =& get_instance();
        if ( $success ){
            $CI->session->set_flashdata('success',$succmsg);
        }else{
            $CI->session->set_flashdata('error', $failmsg);
        }
        return redirect($redirect);
    }
}

if ( ! function_exists('access'))
{
    function access($menu,$operation)
    {
        $CI =& get_instance();
        $role = $CI->session->userdata('role');
        $access = $CI->main->check('access', array('role'=>$role, 'menu'=>$menu, 'operation' => $operation),'id');
        if ( $access || $role === 'super admin'){
            return true;
        }else{
            return false;
        }
    }
}

if ( ! function_exists('error_404'))
{
    function error_404()
    {
        $CI =& get_instance();
        $CI->load->view('error_404');
    }
}

if ( ! function_exists('images'))
{
    function images($uri='')
    {
        return base_url('assets/images/').$uri;
    }
}

if ( ! function_exists('e_id'))
{
    function e_id($id)
    {
        return 41254 * $id;
    }
}

if ( ! function_exists('d_id'))
{
    function d_id($id)
    {
        return $id / 41254;
    }
}