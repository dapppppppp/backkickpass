Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('face_data')->nullable(); // Untuk menyimpan data wajah pengguna
    $table->timestamps();
});
