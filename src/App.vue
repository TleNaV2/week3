<template>
  <div>
    <nav class="navbar">
      <router-link class="brand" to="/">Navbar</router-link>
      <div class="links">
        <router-link to="/">Home</router-link>
        <router-link to="/customer">Customer</router-link>
        <router-link to="/employee">Employee</router-link>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<style>
#app { color: #2e0104; }
.navbar { align-items: center; background: #e3f2fd; display: flex; justify-content: space-between; padding: 14px 8%; }
.brand { color: #2c3e50; font-size: 20px; font-weight: bold; text-decoration: none; }.links { display: flex; gap: 22px; }.links a { color: #2c3e50; text-decoration: none; }.links a.router-link-exact-active { color: #1946d8; font-weight: bold; }
@media (max-width: 600px) { .navbar { padding: 14px 20px; }.links { gap: 10px; }.links a { font-size: 12px; } }
</style>
