<header>
...
</header>
<nav>
 <ul>
  <li><?php echo $this->Html->link(__('Add Jobs', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
  <li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
  <li><?php echo $this->Html->link(__('List Friends', true), array('controller' => 'friends', 'action' => 'index')); ?> </li>
 </ul>
</nav>
<div>
Point: <?php echo $user['User']['point']; ?>
</div>
<div>
 Avator:
</div>
<div>
 Level:
</div>
<footer>
biteup (c)
</footer>
