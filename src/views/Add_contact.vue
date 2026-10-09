<template>
  <div class="container mt-4 col-md-5 bg-body-secondary rounded p-4">
    <h2 class="text-center mb-3">เพิ่มข้อมูลติดต่อเรา</h2>

    <form @submit.prevent="addData">
      <div class="mb-3">
        <label class="form-label">หัวข้อ</label>
        <input v-model="contact.subject" class="form-control" placeholder="หัวข้อ" required />
      </div>

      <div class="mb-3">
        <label class="form-label">รายละเอียด</label>
        <textarea v-model="contact.detail" class="form-control" rows="4" placeholder="รายละเอียด" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">ชื่อ-นามสกุล</label>
        <input v-model="contact.fullname" class="form-control" placeholder="ชื่อ-นามสกุล" required />
      </div>

      <div class="mb-3">
        <label class="form-label">อีเมล</label>
        <input v-model="contact.email" type="email" class="form-control" placeholder="E-mail" required />
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary mb-3">บันทึก</button>
        <button type="reset" class="btn btn-secondary mb-3 ms-2">ยกเลิก</button>
      </div>
    </form>

    <div v-if="message" class="alert alert-info mt-3">
      {{ message }}
    </div>
  </div>
</template>

<script>
import { API_BASE } from "../config";

export default {
  data() {
    return {
      contact: {
        subject: "",
        detail: "",
        fullname: "",
        email: ""
      },
      message: ""
    }
  },
  methods: {
    async addData() {
      try {
        const res = await fetch(`${API_BASE}/add_contact.php`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(this.contact)
        })

        const data = await res.json()
        this.message = data.message

        if (data.success) {
          this.contact = { subject: "", detail: "", fullname: "", email: "" }
          this.$router.push('/contact')
        }
      } catch (err) {
        this.message = "เกิดข้อผิดพลาด: " + err.message
      }
    }
  }
}
</script>
