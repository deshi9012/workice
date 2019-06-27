<?php if(count(Auth::user()->unreadNotifications)): ?>
<li class="hidden-xs notif">
 
          <a href="#topAlerts" class="dropdown-toggle" data-toggle="class:show animated fadeInRight">
          	<?php echo e(svg_image('solid/bell')); ?>
            <span class="badge badge-sm up bg-success m-l-n-sm display-inline" data-count="0">
            	<span class="notif-count"><?php echo e(count(Auth::user()->unreadNotifications)); ?></span>
            </span>
          </a>
  </li>
<?php endif; ?>
      