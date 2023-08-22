<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 15:29:36
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-08 14:34:14
 */
?>
@extends('layouts.app')

@section('content')
    <?php echo \Roots\view(\Roots\app('sage.woocommerce.view'), \Roots\app('sage.data'))->render(); ?>
@endsection
