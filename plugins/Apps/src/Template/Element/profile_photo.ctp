<div class="text-center">
    <?php
    if (isset($user->profile->profile_pic) && $user->profile->profile_pic) {
        echo $this->Html->image('profiles/' . $user->profile->profile_pic,
            [
                'class' => 'avatar img-circle img-thumbnail',
                'alt' => $user->profile->name,
                'url' =>
                    [
                        'controller' => 'users',
                        'action' => 'profile'
                    ]
            ]);
    }
    else{
        echo $this->Html->image('profile_avater.jpg', ['class' => 'avatar img-circle img-thumbnail', 'alt' => 'Profile Photo', 'url' => ['controller' => 'users', 'action' => 'profile']]);
    }
    ?>

    <h6>Upload a different photo...</h6>
    <?php
    echo $this->Form->create($user,
        [
            'controller' => 'users',
            'action' => 'change_photo',
            'enctype' => 'multipart/form-data'
        ]
    );
    ?>
    <input name="photo" type="file" class="text-center center-block well well-sm" required>
    <button type="submit" class="btn btn-info">Change Photo</button>
    <?php echo $this->Form->end(); ?>
</div>