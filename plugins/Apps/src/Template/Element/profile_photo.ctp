<div class="">
    <?php
    if (isset($profile->profile->profile_pic) && $profile->profile->profile_pic) {
        echo $this->Html->image('profiles/' . $profile->profile->profile_pic,
            [
                'class' => 'avatar img-thumbnail',
                'alt' => $profile->profile->name,
                'url' =>
                    [
                        'controller' => 'users',
                        'action' => 'profile'
                    ]
            ]);
    }
    else{
        echo $this->Html->image('profile_avatar.jpg', ['class' => 'avatar img-thumbnail', 'alt' => 'Profile Photo', 'url' => ['controller' => 'users', 'action' => 'profile']]);
    }
    ?>

    <h6>Upload a different photo...</h6>
    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#changeProfilePhoto">Change Photo</button>
</div>


<div class="modal fade" id="changeProfilePhoto" tabindex="-1" role="dialog" aria-labelledby="changeProfilePhotoLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changeProfilePhotoLabel">Change Profile Photo</h4>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create(null,
                    [
                        'url' => [
                            'controller' => 'users',
                            'action' => 'change_profile_picture',
                        ],
                        'enctype' => 'multipart/form-data'
                    ]
                );
                ?>
                <input name="photo" type="file" class="form-control well-sm" required>
                <br/>
                <button type="submit" class="btn btn-success">Change Photo</button>
                <?php echo $this->Form->end(); ?>
            </div>

        </div>
    </div>
</div>