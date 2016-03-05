<div class="header-inner-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="navigations">
                    <ul>
                        <li><a href="<?php echo base_url('dashboard'); ?>">HOME</a></li>
                        <li><a href="<?php echo base_url('dashboard/wallet'); ?>">WALLET</a></li>
                        <li><a href="<?php echo base_url('dashboard/friends'); ?>">Friends</a></li>
                        <li><a href="<?php echo base_url('dashboard/browse'); ?>">Browse</a></li>
                    </ul>
                </div>
                <div class="right-menu">
                    <div class="right-menu-button-container">
                        <button class="right-menu-button">
                            <img src="<?php echo base_url(); ?>public/images/setting-icon.png" alt="Settings" />
                        </button>
                    </div>
                    <div class="pop-over-menu">
                        <ul>
                            <li><a href="<?php echo base_url('members/edit_profile'); ?>">Account Setting</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="<?php echo base_url('members/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>