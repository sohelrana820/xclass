<div class="ui-kit-9">
    <div class="col-mob">
        <h2>Recent Tasks</h2>
        <?php foreach ($recentTasks as $task): ?>
            <!-- Item -->
            <div class="ui-item">
                <!-- Heading -->
                <div class="ui-heading clearfix">
                    <h5>
                        <?php
                        if ($task->users) {
                            foreach ($task->users as $user) {
                                echo $this->Html->link($user->profile->first_name . ' ' . $user->profile->last_name, ['controller' => 'users', 'action' => 'details', $user->uuid], ['class' => 'task_user_link']);
                            }
                        } else {
                            echo '<label>Not Assigned Yet!</label>';
                        }
                        ?>

                    </h5>
                </div>
                <!-- Date -->
                    <span>
                        <?php echo $this->Time->format($task->created, 'MMM d, Y'); ?>

                        <?php
                        foreach ($task->labels as $label) {
                            echo '<a href="#" class="label label-sm" style="background: ' . $label->color_code . '">' . $label->name . '</a>';
                        }
                        ?>
                    </span>
                <!-- Paragraph -->
                <p>
                    <?php echo $task->task; ?>
                </p>
                <?php
                echo $this->Html->link('View Details', ['controller' => 'tasks', 'action' => 'view', $task->id], ['class' => 'task_link']);
                ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>