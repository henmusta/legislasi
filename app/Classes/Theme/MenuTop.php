<?php

namespace App\Classes\Theme;

use App\Models\MenuManager;
// use App\Models\Theme;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class MenuTop
{

  public static function sidebar()
  {
    $menuManager = new MenuManager;
    $roleId = isset(Auth::user()->roles[0]) ? Auth::user()->roles[0]->id : NULL;
    $menu_list = $menuManager->getall($roleId);
    $roots = $menu_list->where('parent_id', 0) ?? array();
    return self::tree($roots, $menu_list, $roleId);
  }




  public static function tree($roots, $menu_list, $roleId, $parentId = 0)
  {

    $html = ' <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon nav-icon" data-eva="grid-outline"></i>
                                <span data-key="t-dashboards">Dashboards</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                            <a href="index-2.html" class="dropdown-item" data-key="t-ecommerce">Ecommerce</a>
                            <a href="dashboard-saas.html" class="dropdown-item" data-key="t-saas">Saas</a>
                            <a href="dashboard-crypto.html" class="dropdown-item" data-key="t-crypto">Crypto</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon nav-icon" data-eva="cube-outline"></i>
                            <span data-key="t-elements">Elements</span> <div class="arrow-down"></div>
                            </a>

                            <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                <div class="ps-2 p-lg-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div>
                                                <div class="menu-title">Elements</div>
                                                <div class="row g-0">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <a href="ui-alerts.html" class="dropdown-item" data-key="t-alerts">Alerts</a>
                                                            <a href="ui-buttons.html" class="dropdown-item" data-key="t-buttons">Buttons</a>
                                                            <a href="ui-cards.html" class="dropdown-item" data-key="t-cards">Cards</a>
                                                            <a href="ui-carousel.html" class="dropdown-item" data-key="t-carousel">Carousel</a>
                                                            <a href="ui-dropdowns.html" class="dropdown-item" data-key="t-dropdowns">Dropdowns</a>
                                                            <a href="ui-grid.html" class="dropdown-item" data-key="t-grid">Grid</a>
                                                            <a href="ui-images.html" class="dropdown-item" data-key="t-images">Images</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <a href="ui-lightbox.html" class="dropdown-item" data-key="t-lightbox">Lightbox</a>
                                                            <a href="ui-modals.html" class="dropdown-item" data-key="t-modals">Modals</a>
                                                            <a href="ui-offcanvas.html" class="dropdown-item" data-key="t-offcanvas">Offcanvas</a>
                                                            <a href="ui-rangeslider.html" class="dropdown-item" data-key="t-range-slider">Range Slider</a>
                                                            <a href="ui-progressbars.html" class="dropdown-item" data-key="t-progress-bars">Progress Bars</a>
                                                            <a href="ui-sweet-alert.html" class="dropdown-item" data-key="t-sweet-alert">Sweet-Alert</a>
                                                            <a href="ui-tabs-accordions.html" class="dropdown-item" data-key="t-tabs-accordions">Tabs & Accordions</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <a href="ui-typography.html" class="dropdown-item" data-key="t-typography">Typography</a>
                                                            <a href="ui-video.html" class="dropdown-item" data-key="t-video">Video</a>
                                                            <a href="ui-general.html" class="dropdown-item" data-key="t-general">General</a>
                                                            <a href="ui-colors.html" class="dropdown-item" data-key="t-colors">Colors</a>
                                                            <a href="ui-rating.html" class="dropdown-item" data-key="t-rating">Rating</a>
                                                            <a href="ui-notifications.html" class="dropdown-item" data-key="t-notifications">Notifications</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <i class="icon nav-icon" data-eva="archive-outline"></i>
                                <span data-key="t-apps">Apps</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Calendar</a>
                                <a href="apps-chat.html" class="dropdown-item" data-key="t-chat">Chat</a>
                                <a href="apps-file-manager.html" class="dropdown-item" data-key="t-filemanager">File Manager</a>


                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                        role="button">
                                        <span data-key="t-ecommerce">Ecommerce</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                        <a href="ecommerce-products.html" class="dropdown-item" data-key="t-products">Products</a>
                                        <a href="ecommerce-product-detail.html" class="dropdown-item" data-key="t-product-detail">Product Detail</a>
                                        <a href="ecommerce-orders.html" class="dropdown-item" data-key="t-orders">Orders</a>
                                        <a href="ecommerce-customers.html" class="dropdown-item" data-key="t-customers">Customers</a>
                                        <a href="ecommerce-cart.html" class="dropdown-item" data-key="t-cart">Cart</a>
                                        <a href="ecommerce-checkout.html" class="dropdown-item" data-key="t-checkout">Checkout</a>
                                        <a href="ecommerce-shops.html" class="dropdown-item" data-key="t-shops">Shops</a>
                                        <a href="ecommerce-add-product.html" class="dropdown-item" data-key="t-add-product">Add Product</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                        role="button">
                                        <span data-key="t-email">Email</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                        <a href="email-inbox.html" class="dropdown-item" data-key="t-inbox">Inbox</a>
                                        <a href="email-read.html" class="dropdown-item" data-key="t-read-email">Read Email</a>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email-templates" role="button">
                                                <span data-key="t-email-templates">Templates</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-email-templates">
                                                <a href="email-template-basic.html" class="dropdown-item" data-key="t-basic-action">Basic Action</a>
                                                <a href="email-template-alert.html" class="dropdown-item" data-key="t-alert-email">Alert Email</a>
                                                <a href="email-template-billing.html" class="dropdown-item" data-key="t-bill-email">Billing Email</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoices"
                                        role="button">
                                    <span data-key="t-invoices">Invoices</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-invoices">
                                        <a href="invoices-list.html" class="dropdown-item" data-key="t-invoice-list">Invoice List</a>
                                        <a href="invoices-detail.html" class="dropdown-item" data-key="t-invoice-detail">Invoice Detail</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-projects"
                                        role="button">
                                    <span data-key="t-projects">Projects</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-projects">
                                    <a href="projects-grid.html" class="dropdown-item" data-key="t-p-grid">Projects Grid</a>
                                    <a href="projects-list.html" class="dropdown-item" data-key="t-p-list">Projects List</a>
                                    <a href="projects-create.html" class="dropdown-item" data-key="t-create-new">Create New</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                        role="button">
                                    <span data-key="t-contacts">Contacts</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                        <a href="contacts-grid.html" class="dropdown-item" data-key="t-user-grid">User Grid</a>
                                        <a href="contacts-list.html" class="dropdown-item" data-key="t-user-list">User List</a>
                                        <a href="contacts-profile.html" class="dropdown-item" data-key="t-user-profile">Profile</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                                <i class="icon nav-icon" data-eva="layers-outline"></i>
                                <span data-key="t-components">Components</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-components">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                        role="button">
                                        <span data-key="t-forms">Forms</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-form">
                                        <a href="form-elements.html" class="dropdown-item" data-key="t-form-elements">Form Elements</a>
                                        <a href="form-layouts.html" class="dropdown-item" data-key="t-form-layouts">Form Layouts</a>
                                        <a href="form-validation.html" class="dropdown-item" data-key="t-form-validation">Form Validation</a>
                                        <a href="form-advanced.html" class="dropdown-item" data-key="t-form-advanced">Form Advanced</a>
                                        <a href="form-editors.html" class="dropdown-item" data-key="t-form-editors">Form Editors</a>
                                        <a href="form-uploads.html" class="dropdown-item" data-key="t-form-upload">Form File Upload</a>
                                        <a href="form-wizard.html" class="dropdown-item" data-key="t-form-wizard">Form Wizard</a>
                                        <a href="form-mask.html" class="dropdown-item" data-key="t-form-mask">Form Mask</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                        role="button">
                                        <span data-key="t-tables">Tables</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-table">
                                        <a href="tables-basic.html" class="dropdown-item" data-key="t-basic-tables">Basic Tables</a>
                                        <a href="tables-advanced.html" class="dropdown-item" data-key="t-advanced-tables">Advance Tables</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                        role="button">
                                        <span data-key="t-charts">Charts</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                                role="button">
                                                <span data-key="t-apex-charts">Apex Charts</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                                <a href="charts-line.html" class="dropdown-item" data-key="t-line">Line</a>
                                                <a href="charts-area.html" class="dropdown-item" data-key="t-area">Area</a>
                                                <a href="charts-column.html" class="dropdown-item" data-key="t-column">Column</a>
                                                <a href="charts-bar.html" class="dropdown-item" data-key="t-bar">Bar</a>
                                                <a href="charts-mixed.html" class="dropdown-item" data-key="t-mixed">Mixed</a>
                                                <a href="charts-timeline.html" class="dropdown-item" data-key="t-timeline">Timeline</a>
                                                <a href="charts-candlestick.html" class="dropdown-item" data-key="t-candlestick">Candlestick</a>
                                                <a href="charts-boxplot.html" class="dropdown-item" data-key="t-boxplot">Boxplot</a>
                                                <a href="charts-bubble.html" class="dropdown-item" data-key="t-bubble">Bubble</a>
                                                <a href="charts-scatter.html" class="dropdown-item" data-key="t-scatter">Scatter</a>
                                                <a href="charts-heatmap.html" class="dropdown-item" data-key="t-heatmap">Heatmap</a>
                                                <a href="charts-treemap.html" class="dropdown-item" data-key="t-treemap">Treemap</a>
                                                <a href="charts-pie.html" class="dropdown-item" data-key="t-pie">Pie</a>
                                                <a href="charts-radialbar.html" class="dropdown-item" data-key="t-radialbar">Radialbar</a>
                                                <a href="charts-radar.html" class="dropdown-item" data-key="t-radar">Radar</a>
                                                <a href="charts-polararea.html" class="dropdown-item" data-key="t-polararea">Polararea</a>
                                            </div>
                                        </div>
                                        <a href="charts-echart.html" class="dropdown-item" data-key="t-e-charts">E Charts</a>
                                        <a href="charts-chartjs.html" class="dropdown-item" data-key="t-chartjs-charts">Chartjs Charts</a>
                                        <a href="charts-tui.html" class="dropdown-item" data-key="t-ui-charts">Toast UI Charts</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                        role="button">
                                        <span data-key="t-icons">Icons</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                        <a href="icons-evaicons.html" class="dropdown-item" data-key="t-evaicons">Eva Icons</a>
                                        <a href="icons-boxicons.html" class="dropdown-item" data-key="t-boxicons">Boxicons</a>
                                        <a href="icons-materialdesign.html" class="dropdown-item" data-key="t-material-design">Material Design</a>
                                        <a href="icons-fontawesome.html" class="dropdown-item" data-key="t-font-awesome">Font Awesome 5</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                        role="button">
                                        <span data-key="t-maps">Maps</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-map">
                                        <a href="maps-google.html" class="dropdown-item" data-key="t-google">Google</a>
                                        <a href="maps-vector.html" class="dropdown-item" data-key="t-vector">Vector</a>
                                        <a href="maps-leaflet.html" class="dropdown-item" data-key="t-leaflet">Leaflet</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                <i class="icon nav-icon" data-eva="file-text-outline"></i>
                                <span data-key="t-pages">Pages</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-more">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-authentication"
                                        role="button">
                                        <span data-key="t-authentication">Authentication</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-authentication">
                                        <a href="auth-login.html" class="dropdown-item" data-key="t-login">Login</a>
                                        <a href="auth-register.html" class="dropdown-item" data-key="t-register">Register</a>
                                        <a href="auth-recoverpw.html" class="dropdown-item" data-key="t-recover-password">Recover Password</a>
                                        <a href="auth-lock-screen.html" class="dropdown-item" data-key="t-lock-screen">Lock Screen</a>
                                        <a href="auth-logout.html" class="dropdown-item" data-key="t-logout">Logout</a>
                                        <a href="auth-confirm-mail.html" class="dropdown-item" data-key="t-confirm-mail">Confirm Mail</a>
                                        <a href="auth-email-verification.html" class="dropdown-item" data-key="t-email-verification">Email Verification</a>
                                        <a href="auth-two-step-verification.html" class="dropdown-item" data-key="t-two-step-verification">Two Step Verification</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                        role="button">
                                        <span data-key="t-utility">Utility</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                        <a href="pages-starter.html" class="dropdown-item" data-key="t-starter-page">Starter Page</a>
                                        <a href="pages-maintenance.html" class="dropdown-item" data-key="t-maintenance">Maintenance</a>
                                        <a href="pages-comingsoon.html" class="dropdown-item" data-key="t-coming-soon">Coming Soon</a>
                                        <a href="pages-timeline.html" class="dropdown-item" data-key="t-timeline">Timeline</a>
                                        <a href="pages-faqs.html" class="dropdown-item" data-key="t-faqs">FAQs</a>
                                        <a href="pages-pricing.html" class="dropdown-item" data-key="t-pricing">Pricing</a>
                                        <a href="pages-404.html" class="dropdown-item" data-key="t-error-404">Error 404</a>
                                        <a href="pages-500.html" class="dropdown-item" data-key="t-error-500">Error 500</a>
                                    </div>
                                </div>

                                <a href="layouts-horizontal.html" class="dropdown-item" data-key="t-horizontal">Horizontal</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>';


    return $html;

  }


  public static function children($roots, $menu_list, $roleId, $parentId = 0){
    $segment ='/'.request()->segment(1). '/' .request()->segment(2);
    foreach ($roots as $item) {
     //   $show = (isset($item->menupermission->path_url)  ?  ($segment == $item->menupermission->path_url) ? 'show' : '' : '');
        $html = '<ul class="mininav-content nav collapse" >';
    }


    foreach ($roots as $item) {
      $find = $menu_list->where('parent_id', $item['id']);
      if ($find->count() > 0) {
        $htmlChildren = self::children($find, $menu_list, $roleId, $item['id']);
        $active = (isset($item->menupermission->path_url)  ?  ($segment == $item->menupermission->path_url) ? 'active' : '' : '');
        $html .= '
        <li class="nav-item '.($find->count() > 0  ? "has-sub" : '').' ">
            <a class=" mininav-toggle nav-link  '. (isset($item->menupermission->path_url)  ?  ($segment == $item->menupermission->path_url) ? 'active' : '' : '').'">
            <i  style="padding-right:10px;" class="' . (!$item->menu_permission_id ? $item->icon : $item->menupermission->icon) . '"></i>
                ' . (!$item->menu_permission_id ? $item->title : $item->menupermission->title) . '
            </a>
            '.$htmlChildren.'
        </li>';
      }else{
        $html .= '
        <li class="nav-item">
            <a class="nav-link '. (isset($item->menupermission->path_url)  ?  ($segment == $item->menupermission->path_url) ? 'active' : '' : '').'" href="'.(!$item->menu_permission_id ? ($item->path_url ? $item->path_url : '#') : $item->menupermission->path_url).'">
            <i  style="width:20px;" class="' . (!$item->menu_permission_id ? $item->icon : $item->menupermission->icon) . '"  >
            </i>
                ' . (!$item->menu_permission_id ? $item->title : $item->menupermission->title) . '
            </a>
        </li>';
      }
    }
    $html .= '</ul>';
    return $html;
  }
}
