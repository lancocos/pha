{{ form('area/search') }}
{% for elem in form  %}
    <div>{{elem.label() }} {{ elem }}</div>
    {% endfor %}
{{ submit_button("submit") }}
{{ endForm() }}