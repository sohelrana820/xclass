<div class="paginator pagination_full">
    <div>
        <small class="text-muted">
            <?php echo $this->Paginator->counter('showing {{current}} records out of {{count}} total'); ?>
        </small>
    </div>
    <ul class="pagination">
        <?php echo $this->Paginator->prev(__('«')) ?>
        <?php echo $this->Paginator->next(__('»')) ?>
    </ul>
</div>