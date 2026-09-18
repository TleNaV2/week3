<template>
  <div class="container page">
    <div class="header-row">
      <div>
        <h1>ติดต่อเรา</h1>
        <p class="lead">ข้อมูลติดต่อทั้งหมด</p>
      </div>
      <router-link to="/add-contact" class="btn btn-primary">เพิ่มข้อมูลติดต่อ</router-link>
    </div>

    <table class="contact-table">
      <thead>
        <tr>
          <th>ลำดับที่</th>
          <th>รหัสติดต่อ</th>
          <th>หัวข้อ</th>
          <th>รายละเอียด</th>
          <th>ชื่อ-นามสกุล</th>
          <th>Email</th>
          <th>วันที่สร้าง</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(contact, index) in contacts" :key="contact.contact_id">
          <td>{{ index + 1 }}</td>
          <td>{{ contact.contact_id }}</td>
          <td>{{ contact.subject }}</td>
          <td>{{ contact.detail }}</td>
          <td>{{ contact.fullname }}</td>
          <td>{{ contact.email }}</td>
          <td>{{ formatDate(contact.created_at) }}</td>
        </tr>
      </tbody>
    </table>

    <div v-if="loading" class="text-center">
      <p>กำลังโหลดข้อมูล...</p>
    </div>

    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'

export default {
  name: 'ContactList',

  setup() {
    const contacts = ref([])
    const loading = ref(true)
    const error = ref(null)

    const formatDate = (value) => {
      if (!value) return '-'
      return new Date(value).toLocaleString('th-TH', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      })
    }

    const fetchContacts = async () => {
      try {
        const response = await fetch('http://localhost/week3_68704511/week3/php.api/show_contact.php')

        if (!response.ok) {
          throw new Error('ไม่สามารถดึงข้อมูลติดต่อเราได้')
        }

        const result = await response.json()

        if (!result.success || !Array.isArray(result.data)) {
          throw new Error(result.message || 'รูปแบบข้อมูลติดต่อไม่ถูกต้อง')
        }

        contacts.value = result.data
      } catch (err) {
        error.value = err.message
      } finally {
        loading.value = false
      }
    }

    onMounted(() => {
      fetchContacts()
    })

    return {
      contacts,
      loading,
      error,
      formatDate
    }
  }
}
</script>

<style scoped>
.page { margin: 0 auto; max-width: 1200px; padding: 40px 24px 60px; }
.page h1 { color: #173d3b; }
.lead { color: #6c757d; margin-bottom: 24px; }
.header-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}
.btn { border-radius: 10px; }
.contact-table { background: #fff; border-collapse: collapse; width: 100%; }
.contact-table th, .contact-table td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
.contact-table th { background: #212529; color: #fff; }
.text-center { text-align: center; }
.alert { margin-top: 16px; }
</style>
