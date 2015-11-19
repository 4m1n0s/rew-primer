<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class BackendAsset
 *
 * @author Stableflow
 */
class BackendAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        '/backend/global/plugins/font-awesome/css/font-awesome.min.css',
        '/backend/global/plugins/simple-line-icons/simple-line-icons.min.css',
        '/backend/global/plugins/bootstrap/css/bootstrap.min.css',
        '/backend/global/plugins/uniform/css/uniform.default.css',
        '/backend/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        
        '/backend/global/plugins/datatables/datatables.min.css',
        '/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
        '/backend/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
        
        '/backend/global/plugins/morris/morris.css',
        '/backend/global/plugins/fullcalendar/fullcalendar.min.css',
        '/backend/global/plugins/jqvmap/jqvmap/jqvmap.css',

        '/backend/global/css/components.min.css',
        '/backend/global/css/plugins.min.css',
        
        
        '/backend/layouts/layout/css/layout.min.css',
        '/backend/layouts/layout/css/themes/darkblue.min.css',
        '/backend/layouts/layout/css/custom.min.css',
    ];
    
    
            
    public $js = [
        '/backend/global/plugins/bootstrap/js/bootstrap.min.js', 
        '/backend/global/plugins/js.cookie.min.js', 
        '/backend/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js', 
        '/backend/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js', 
        '/backend/global/plugins/jquery.blockui.min.js', 
        '/backend/global/plugins/uniform/jquery.uniform.min.js', 
        '/backend/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js', 
        
        '/backend/global/plugins/morris/morris.min.js', 
        '/backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        
        '/backend/global/scripts/app.min.js',
        

        '/backend/layouts/layout/scripts/layout.min.js',
        '/backend/layouts/layout/scripts/demo.min.js',
        '/backend/layouts/global/scripts/quick-sidebar.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}





