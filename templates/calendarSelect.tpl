<div>
    <form action="">
    <select name="calendar-select">
    {foreach from=$calendars item=$calendar}
        <option value="{$calendar->name}">{$calendar->name}</option>
    {/foreach}
    </select>
    <input type="submit" value="Switch Calendar">
    </form>
</div>