<ul class="pagination">
<?
  $optionsForSide = array(
		    'tag' => 'li',
		    'class' => 'disabled',
		    'disabledTag' => 'a'
  );
  $optionsForNum = array(
		    'tag' => 'li',
		    'separator' => false,
		    'currentTag' => 'a',
		    'currentClass' => 'active',
		    'first' => 1,
		    'ellipsis' => '<li class="disabled"><a>...</a></li>'
  );
echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, $optionsForSide);
echo $this->Paginator->numbers($optionsForNum);
echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, $optionsForSide);
?>
</ul>


<?php
  /*
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
  */
?>