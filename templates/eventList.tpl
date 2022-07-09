<div>
    <ul class="event-list">
    {foreach from=$events item=$event}
        <li style="border: 1px solid {$event->color}">
            <h2>Title: {$event->title}</h2>
            <p>Description: {$event->description}</p>
            <p>Start date: {$event->start_date}</p>
            <p>Hour: {$event->hour}</p>
            {if isset($event->end_date)}
                <p>End date: {$event->end_date}</p>
            {/if}
        </li>
    {/foreach}
    </ul>
</div>