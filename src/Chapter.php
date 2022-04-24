<?php

namespace CT275\Labs;

use PDO;

class Chapter
{
	private $db;

	private $id = -1;
	public $name;
	public $tacgia;
	public $notes;
	public $created_at;
	public $updated_at;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct(PDO $pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['name'])) {
			$this->name = trim($data['name']);
		}

		if (isset($data['tacgia'])) {
			
			$this->tacgia = trim($data['tacgia']);
		}

		if (isset($data['notes'])) {
			$this->notes = trim($data['notes']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->name) {
			$this->errors['name'] = 'Invalid name.';
		}

		if (!$this->tacgia) {
			$this->errors['tacgia'] = 'Invalid tac gia .';
		}

		if (strlen($this->notes) > 255) {
			$this->errors['notes'] = 'Notes must be at most 255 characters.';
		}

		return empty($this->errors);
	}
    public function all()
    {
		$Chapters = [];
        $stmt = $this->db->prepare('select * from Chapter');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $Chapter = new Chapter($this->db);
            $Chapter->fillFromDB($row);
            $Chapters[] = $Chapter;
        } return $Chapters;
    
    }
    protected function fillFromDB(array $row)
    {
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->tacgia = $row['tacgia'];
        $this->notes = $row['notes'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
        return $this;
    }
	public function save()
{
$result = false;
if ($this->id >= 0) {
$stmt = $this->db->prepare('update Chapter set name = :name,
tacgia = :tacgia, notes = :notes, updated_at = now()
where id = :id');
$result = $stmt->execute([
'name' => $this->name,
'tacgia' => $this->tacgia,
'notes' => $this->notes,
'id' => $this->id]);
} else {
$stmt = $this->db->prepare(
'insert into Chapter (name, tacgia, notes, created_at, updated_at)
values (:name, :tacgia, :notes, now(), now())');
$result = $stmt->execute([
'name' => $this->name,
'tacgia' => $this->tacgia,
'notes' => $this->notes]);
if ($result) {
$this->id = $this->db->lastInsertId();
}
}
return $result;
}
public function find($id)
{
$stmt = $this->db->prepare('select * from Chapter where id = :id');
$stmt->execute(['id' => $id]);
if ($row = $stmt->fetch()) {
$this->fillFromDB($row);
return $this;
}
return null;
}
public function update(array $data)
{
$this->fill($data);
if ($this->validate()) {
return $this->save();
}
return false;
}
public function delete()
{
$stmt = $this->db->prepare('delete from Chapter where id = :id');
return $stmt->execute(['id' => $this->id]);
}
}
