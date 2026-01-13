<?php
include 'db_conn.php';

$notes = [];
$result = $conn->query("SELECT title, note FROM notes ORDER BY title ASC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Notepad</title>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-title">Notepad</div>
        <button id="newNoteBtn">+ New Note</button>
    </div>
    <div class="notes-list" id="notesList">
        <?php foreach ($notes as $note): ?>
            <div class="note-item" data-title="<?= htmlspecialchars($note['title']) ?>" data-note="<?= htmlspecialchars($note['note']) ?>">
                <?= htmlspecialchars($note['title']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="main-content" id="mainContent">
    <div id="emptyState">Select a note or create a new one</div>
</div>

<template id="editorTemplate">
    <form class="editor-form" method="post" action="actions.php">
        <div class="editor-header">
            <input type="text" name="title" class="editor-title" placeholder="Title" required>
            <button type="submit" name="action" value="save">Save</button>
            <button type="submit" name="action" value="delete">Delete</button>
        </div>
        <textarea name="note" placeholder="Content"></textarea>
    </form>
</template>

<script>
const notesList = document.getElementById('notesList');
const mainContent = document.getElementById('mainContent');
const emptyState = document.getElementById('emptyState');
const newNoteBtn = document.getElementById('newNoteBtn');
const editorTemplate = document.getElementById('editorTemplate').content;

function openEditor(title = '', content = '') {
    mainContent.innerHTML = '';
    const editor = editorTemplate.cloneNode(true);
    const form = editor.querySelector('.editor-form');
    form.querySelector('.editor-title').value = title;
    form.querySelector('textarea').value = content;
    mainContent.appendChild(editor);
}

notesList.querySelectorAll('.note-item').forEach(item => {
    item.addEventListener('click', () => {
        openEditor(item.dataset.title, item.dataset.note);
    });
});

newNoteBtn.addEventListener('click', () => {
    openEditor('', '');
});
</script>

</body>
</html>
