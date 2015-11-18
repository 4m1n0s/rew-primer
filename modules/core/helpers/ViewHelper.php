<?php

namespace app\modules\core\helpers;

/**
 * Class ViewHelper
 *
 * @author Stableflow
 */
class ViewHelper {

    public static function gridViewLayout() {
        return "
            <div class=\"dataTables_wrapper no-footer\">
                <div class=\"table-scrollable\">
                    {items} 
                </div>
                <div class=\"row\"> 
                    <div class=\"col-md-5 col-sm-12\">
                        <div class=\"dataTables_info\" role=\"status\" aria-live=\"polite\">{summary}</div>
                    </div>
                    <div class=\"col-md-7 col-sm-12\">
                        <div class=\"dataTables_paginate paging_bootstrap_number\">
                            {pager}
                        </div>
                    </div>
                </div>
            </div>";
    }

}
