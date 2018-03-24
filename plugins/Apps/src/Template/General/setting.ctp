<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('General Settings', ['controller' => 'settings', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>General Settings</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php echo $this->Form->create('', ['type' => 'file']);?>
        <div class="row">
            <div class="col-lg-8">
                <?php if(isset($settings['logo'])):?>
                <div class="form-group">
                    <label>Current Logo</label>
                    <div class="old_logo">
                        <?php echo $this->Html->image($settings['logo']); ?>
                    </div>
                </div>
                <?php endif;?>
                <div class="form-group">
                    <label>Application logo</label>
                    <div class="input text">
                        <input type="file" name="application_logo" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Application name</label>
                    <div class="input text">
                        <input type="text" name="name" class="form-control" value="<?php echo isset($settings['name']) ? $settings['name'] : null;?>" placeholder="Application name">
                    </div>
                </div>

                <div class="form-group">
                    <label>Copyright text</label>
                    <div class="input text">
                        <input type="text" name="copyright" class="form-control" value="<?php echo isset($settings['copyright']) ? $settings['copyright'] : null;?>" placeholder="Copyright text">
                    </div>
                </div>

                <div class="form-group">
                    <label>How may users show per page</label>
                    <div class="input text">
                        <input type="number" name="users_per_page" class="form-control" value="<?php echo isset($settings['users_per_page']) ? $settings['users_per_page'] : null;?>" placeholder="e.g 50">
                    </div>
                </div>

                <div class="form-group">
                    <label>How may documents show per page</label>
                    <div class="input text">
                        <input type="number" name="documents_per_page" class="form-control" value="<?php echo isset($settings['documents_per_page']) ? $settings['documents_per_page'] : null;?>" placeholder="e.g 50">
                    </div>
                </div>

                <div class="form-group">
                    <label>How may histories show per page</label>
                    <div class="input text">
                        <input type="number" name="history_per_page" class="form-control" value="<?php echo isset($settings['history_per_page']) ? $settings['history_per_page'] : null;?>" placeholder="e.g 50">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Settings</button>
        <?php echo $this->Form->end();?>
    </div>
</div>
