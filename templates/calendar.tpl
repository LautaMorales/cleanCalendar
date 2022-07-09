{include file="header.tpl"}

{include file='calendarSelect.tpl'}

<div class="main-container">
    <table class="calendar">
        <thead>
            {for $day=0 to 6}
                {if $dayArray[$day] eq 'Sun' || $dayArray[$day] eq 'Sat'}
                    <th class="th-weekend">{$dayArray[$day]}</th>
                {else}
                    <th class="th-weekday">{$dayArray[$day]}</th>    
                {/if}
                
            {/for}    
        </thead>
        <tbody>
            <tr>
            {for $offset=1 to $calOffset}
                <td class="offset-day"></td>
            {/for}

            {for $day=1 to $monthDays}
                {if ($day+$calOffset-1) % 7 eq 0}
                    </tr>
                    <tr>
                {/if}
                {if isset($eventDays[$day])}
                    <td class="calendar-day has-event" style="background-color:#{$eventDays[$day]}">{$day}</td>
                {else}
                    <td class="calendar-day">{$day}</td>
                {/if}
            {/for}
            </tr>
        </tbody>
    </table>
</div>

{include file="eventList.tpl"}

{include file="footer.tpl"}