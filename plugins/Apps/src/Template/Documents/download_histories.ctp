<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>


<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Download Histories</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if (!$downloads->isEmpty()): ?>
            <table class="table theme-table">
                <thead>
                <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Document Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Download Time</th>
                    <th scope="col" class="actions"><?php echo __('Actions') ?></th>
                </tr>
                </thead>
                <?php foreach ($downloads as $download): ?>
                    <tr>
                        <td><?php echo $this->Html->link($download->user->profile->first_name .' ' . $download->user->profile->first_name, ['controller' => 'users', 'action' => 'view', $download->user->uuid] ) ; ?></td>
                        <td><?php echo $this->Html->link($download->document->title, ['controller' => 'documents', 'action' => 'view', $download->document->uuid] ) ; ?></td>
                        <td><?php echo $download->document->course ? $download->document->course->name : 'N/A' ?></td>
                        <td>
                            <?php echo $this->Time->format($download->created, 'MMM d, Y') ?>
                            <span class="sm-time">(<?php echo date('H:i A', strtotime($download->created)) ?>)</span>
                        </td>
                        <td class="actions">
                            <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['controller' => 'Download', 'action' => 'delete', $download->id], ['class' => 'icons red', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $download->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $this->element('pagination');?>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
    </div>
</div>


