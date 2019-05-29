{% for area in page.items %}
<div>{{ area.id }} {{ area.name }} {{ area.short_name }} {{ area.pinyin }} {{ area.zip_code }} {{ area.merger_name }}</div>
{% endfor %}