<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Article Posts</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/">Home</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/all">All Article</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/published">Published</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/drafts">Drafts</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/trashed">Trashed</RouterLink>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

