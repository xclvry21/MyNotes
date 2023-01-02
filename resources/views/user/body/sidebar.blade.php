<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('user.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
    
                <li class="menu-title">Notes</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-sticky-note-line"></i>
                        <span>Note</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">All Notes</a></li>
                        <li><a href="#">Create Note</a></li>                        
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-price-tag-3-line"></i>
                        <span>Tags</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('tag.index') }}">All Tags</a></li>
                        <li><a href="{{ route('tag.create') }}">Create Tag</a></li>                        
                    </ul>
                </li>

                <li class="menu-title">Miscellaneous</li>
                <li>
                    <a href="#">
                        <i class="ri-inbox-archive-line"></i>
                        <span>Archives</span>
                    </a>
                    <a href="#">
                        <i class="ri-delete-bin-line"></i>
                        <span>Trash</span>
                    </a>
                    
                </li>

               
              



               
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>