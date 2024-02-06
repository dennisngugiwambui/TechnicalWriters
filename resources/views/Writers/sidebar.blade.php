<style>
    .badge {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 10px;
        padding: 5px 10px;
        border-radius: 50%;
        background: red;
        color: white;
    }

    .main-menu a {
        position: relative;
        display: flex;
        align-items: center;
    }
</style>



<div class="main-menu">
    <div class="menu-inner">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6pZL8MEG/hN7I4dGof/brd1b1ElwBjhp" crossorigin="anonymous">

        <nav>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/available">
                        <i class="fa fa-life-saver">

                        </i>
                        <span>Available</span>
                        <span class="badge">10</span>
                    </a>
                </li>
                <li><a href="/current"><i class="fa fa-user-md"></i> <span>Current</span></a></li>
                <li><a href="/revision"><i class="fa fa-bookmark"></i> <span>Revision</span></a></li>
                <li><a href="/dispute"><i class="fa fa-envelope"></i> <span>Dispute</span></a></li>
                <li><a href="/finished"><i class="fa fa-comment"></i> <span>Finished</span></a></li>

                <li>
                    <a href="/bids">
                        <i class="fa fa-file-archive-o"></i>
                        <span>My Bids</span>
                        <span class="badge">5</span>
                    </a>
                </li>

                <li><a href="/tenants"><i class="fa fa-users"></i> <span>Messages</span></a></li>
                <li><a href="/tenants"><i class="fa fa-users"></i> <span>Finance</span></a></li>
                <li><a href="/tenants"><i class="fa fa-users"></i> <span>Profile</span></a></li>
                <li><a href="/tenants"><i class="fa fa-lock"></i> <span>Logout</span></a></li>
            </ul>
        </nav>

    </div>
</div>
