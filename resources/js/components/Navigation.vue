<template>
  <div id="navigation" role="navigation">
    <div class="container hide-on-small-only">
      <inertia-link class="collection-item" href="/"><img src="/img/logo.png" class="responsive-img" alt="Budget Logo"></inertia-link>
    </div>

    <!-- Sidebar navigation -->
    <div class="collection hide-on-small-only" v-if="!auth">
      <inertia-link class="collection-item" :class="{'is-active': (path === 'login')}" href="/login">Login</inertia-link>
      <inertia-link class="collection-item" :class="{'is-active': (path === 'register')}" href="/register">Register</inertia-link>
    </div>
    <div class="collection hide-on-small-only" v-else>
      <inertia-link class="collection-item" :class="{'is-active': (path === 'budgets')}" :href="$route('budgets.index')">Budgets</inertia-link>
      <inertia-link class="collection-item" :class="{'is-active': (path === 'reports')}" :href="$route('reports.index')">Reports</inertia-link>
      <inertia-link class="collection-item" :class="{'is-active': (path === 'stats')}" :href="$route('stats.index')">Stats</inertia-link>
      <inertia-link class="collection-item" href="/logout">Logout</inertia-link>
    </div>

    <a href="#" data-target="mobile-demo" class="sidenav-trigger hide-on-med-and-up center-align white-text"><i class="material-icons small">menu</i></a>

    <ul class="sidenav" id="mobile-demo" v-if="!auth">
      <li><h3 class="center-align">Budget.io</h3></li>
      <li class="divider"></li>
      <li><inertia-link href="/">Home</inertia-link></li>
      <li><inertia-link :class="{'is-active': (path === 'login')}" href="/login">Login</inertia-link></li>
      <li><inertia-link :class="{'is-active': (path === 'register')}" href="/register">Register</inertia-link></li>
    </ul>
    <ul class="sidenav" id="mobile-demo" v-else>
      <li><h3 class="center-align">Budget.io</h3></li>
      <li class="divider"></li>
      <li><inertia-link href="/">Home</inertia-link></li>
      <li><inertia-link :class="{'is-active': (path === 'budgets')}" :href="$route('budgets.index')">Budgets</inertia-link></li>
      <li><inertia-link :class="{'is-active': (path === 'reports')}" :href="$route('reports.index')">Reports</inertia-link></li>
      <li><inertia-link :class="{'is-active': (path === 'stats')}" :href="$route('stats.index')">Stats</inertia-link></li>
      <li><inertia-link href="/logout">Logout</inertia-link></li>
    </ul>
  </div>
</template>

<script>
  import M from "@materializecss/materialize";
  export default {
    name: "Navigation",
    mounted() {
      M.AutoInit()
    },
    props: {
      auth: {
        String
      },
      path: {
        String
      }
    },
    watch: {
      path: function(value) {
        M.AutoInit()
      }
    }
  }
</script>

<style lang="scss" scoped>
  #navigation {
    background: darkgreen;
    box-shadow: inset -10px 0 5px -5px hsla(0,0%,0%,.25);
    @media only screen and (min-width: 600px) {
      background: #F5F5F5;
      position: fixed;
      height: 100vh;
    }
  }
  .collection {
    border: 0;
    font-size: 1.5rem;
    background-color: white;
    box-shadow: inset -10px 0 5px -5px hsla(0,0%,0%,.25);
    margin: 0;
    .is-active {}
    .collection-item {
      background-color: #F5F5F5;
      padding: 1rem 0 1rem 2rem;
      margin-right: .5rem;
      color: black!important;
      border: 0;
      border-right: .5rem solid transparent;
      &:hover, &.is-active {
        background-color: #ddd;
        border-right: .5rem solid darkgreen;
      }
      &.is-active {
        pointer-events: none;
      }
    }
  }
  .container {
    padding: 1rem 0 1rem 0;
  }
  .sidenav {
    a {
      border: 1px solid transparent;
      &.is-active {
        background-color: #ddd;
        pointer-events: none;
      }
    }
  }
  .sidenav-trigger i {
    padding: 1rem;
  }
</style>
