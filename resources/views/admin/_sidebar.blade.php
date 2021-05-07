<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> 
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a class="menu" href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><router-link class="menu"  to="/dashboard">Owner Dashboard</router-link></li>
                    </ul>
                </li>
               @can('isAdmin')
                <li class="submenu">
                    <a href="#"><i class="la la-users"></i> <span> Hotel </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                       <li>
                       
                        <router-link to="/hotels"> Hotel</router-link>
                        
                       </li>
                       <li>
                        
                       </li>
                    </ul>
                </li>
              
                
                <li class="submenu">
                    <a href="#"><i class="la la-crosshairs"></i> <span> Rates </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <router-link to="/rates"> Rates</router-link>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="submenu">
                    <a href="#"><i class="la la-pie-chart"></i> <span>Search Filter </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        
                        <li>
                            <router-link to="/filter"> Rate Filter</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->