<div class="page-header" style="margin-bottom: 0px !important;">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>


<div class="widget border-less-widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Document Details</h2>
            <span>Details of <?php echo $document->title; ?></span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Document', ['controller' => 'documents', 'action' => 'add'], ['class' => 'btn btn-info'])?>
            <?php echo $this->Html->link('Back to List', ['controller' => 'documents', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="documents view large-9 medium-8 columns content">
            <div class="documents-details">
                <h3 class="title"><?php echo $this->Html->link($document->title, ['action' => 'view', $document->id]); ?></h3>
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?php echo __('Course') ?></th>
                        <td><?php echo $document->course->name; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo __('Title') ?></th>
                        <td><?php echo h($document->title) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo __('Description') ?></th>
                        <td class="text-muted"><?php echo $this->Text->autoParagraph(h($document->description)); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo __('Image') ?></th>
                        <td>
                            <?php
                            $image = 'dummy.png';
                            if($document->image != '') {
                                $image = $document->image;
                            }
                            echo $this->Html->image($image, ['class' => 'doc-list-img', 'alt' => $document->title, 'url' => ['action' => 'view', $document->id]]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo __('Status') ?></th>
                        <td>
                            <?php if ($document->status == 1): ?>
                                <span class="status-text status-text-success">Active</span>
                            <?php elseif ($document->status == 0): ?>
                                <span class="status-text status-text-danger">Inactive</span>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo __('Created') ?></th>
                        <td class="time"><?php echo $this->Time->format($document->created, 'MMM d, Y') ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo __('Modified') ?></th>
                        <td class="time"><?php echo $this->Time->format($document->modified, 'MMM d, Y') ?></td>
                    </tr>
                </table>
            </div>

            <div class="related">
                <div class="widget">
                    <div class="widget-header">Recent  Download Histories</div>
                    <div class="widget-body" style="padding: 20px !important;">
                        <?php if (!empty($document->downloads)): ?>
                            <table class="table theme-table">
                                <thead>
                                <tr>
                                    <th scope="col">Downloaded</th>
                                    <th scope="col"><?php echo __('Created', 'Download Time') ?></th>
                                    <th scope="col" class="actions"><?php echo __('Actions') ?></th>
                                </tr>
                                </thead>
                                <?php foreach ($document->downloads as $download): ?>
                                    <tr>
                                        <td><?php echo $this->Html->link($download->user->profile->first_name .' ' . $download->user->profile->first_name, ['controller' => 'users', 'action' => 'view', $download->user->uuid] ) ; ?></td>
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
                        <?php else: ?>
                            <?php echo $this->element('not_found'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


