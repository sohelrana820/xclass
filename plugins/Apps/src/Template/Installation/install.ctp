<div class="text-center">
    <h2>Welcome to <?php echo $appsName?>!</h2>
    <p class="lead">
        With the task manager, you can easily manage your task list. It allowed to labeling task list, assign task to user and mark them as closed/open
    </p>
    <br/>
    <?php echo $this->Html->link('Getting Started', ['controller' => 'installation', 'action' => 'requirements'], ['class' => 'btn btn-lg-theme']);?>
</div>