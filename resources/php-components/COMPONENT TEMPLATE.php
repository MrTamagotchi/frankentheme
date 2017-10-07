<?php
    // SETTING UP VALUES

    // Put all template args here as strings, example: 'foo', 'bar'
    $all_template_args = [
        'foo'
    ];

    // This will check if the template args are being sent to the template,
    // Otherwise sets them to FALSE to keep the error.log clean
    
    // Outpouts a variable for each arg in the array above, example: $foo; $bar; 
    foreach ($all_template_args as $arg) {
        if( isset($template_args[$arg]) ) {
            ${$arg} = $template_args[$arg];
        } else {
            ${$arg} = false;
        }
    }
?>

<?php // START TEMPLATE ?>
<?php echo $foo; ?>