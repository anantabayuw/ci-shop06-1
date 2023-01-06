<?php

function getDropdownList($tables, $columns)
{
	$CI =& get_instance(); 
	$query = $CI->db->select($columns)->from($tables)->get();

	if($query->num_rows() >= 1) {
		$option1 = ['' => '- Select -'];
		$option2 = array_column($query->result_array(), $columns[1], $columns[0]);
		$option3 = $option1 + $option2;
		return $options;
	}
	return ['' => '- Select -'];
}

function getCategories()
{
	$CI =& get_instance();
	$query = $CI->db->get('category')->result();
	return $query;
}

function getCart()
{
	$CI =& get_instance();
	$userId = $CI->session->userdata('id');

	if($userId) {
		$query = $CI->db->where('id_user',$userId)->count_all_results('cart');
		return $query;
	}

	return false;
}

function hashEncrypt($input)
{
	$hash = password_hash($input, PASSWORD_DEFAULT);
	return $hash;
}

function hashEncryptVerify($input,$hash)
{
	if (password_verify($input, $hash)) {
		return true;
	} else {
		return false;
	}
}