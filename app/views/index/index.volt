<div>
{% for good in page.items %}
    {{ good.id }} {{ good.name }}  {{ good.created_at }}
{% endfor%}
</div>
<a href="/">First</a>
<a href="/?page=<?= $page->before; ?>">Previous</a>
<a href="/?page=<?= $page->next; ?>">Next</a>
<a href="/?page=<?= $page->last; ?>">Last</a>

<?php echo "You are in page ", $page->current, " of ", $page->total_pages; ?>