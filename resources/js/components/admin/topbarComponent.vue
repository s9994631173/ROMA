<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/app#/admin/">АДМИНИСТРАТОР</a>
    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto'>
            <li class='nav-item'>
                <router-link class='nav-link' :to="'/admin/cc'">КЦ</router-link>
            </li>
            <li class='nav-item'>
                <router-link class='nav-link' :to="'/admin/export'">Из РФ в ЕС</router-link>
            </li>
            <li class='nav-item'>
                <router-link class='nav-link' :to="'/admin/guide'">Гайд</router-link>
            </li>
            <li class='nav-item'>
                <router-link class='nav-link' :to="'/admin/insurance'">Страхование</router-link>
            </li>
            <li class='nav-item'>
                <router-link class='nav-link' :to="'/admin/og'">ОГ</router-link>
            </li>
            <li class='nav-item'>
                <router-link class='nav-link' :to="'/admin/pack'">Упаковка</router-link>
            </li>
            <li class='nav-item'>
                <a class="nav-link" href="/stats" target="_blank">Статистика</a>
            </li>
        </ul>
    </div>
</nav>
</template>

<script>

</script>