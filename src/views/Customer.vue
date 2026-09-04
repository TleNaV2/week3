<template>
  <main class="customer-page">
    <h1>ข้อมูลลูกค้า</h1>
    <p>รายชื่อลูกค้าทั้งหมด</p>
    <table>
      <thead><tr><th>ลำดับ</th><th>รหัสลูกค้า</th><th>ชื่อ</th><th>นามสกุล</th><th>เบอร์โทร</th><th>ชื่อผู้ใช้</th></tr></thead>
      <tbody><tr v-for="(customer, index) in customers" :key="customer.customer_id"><td>{{ index + 1 }}</td><td>{{ customer.customer_id }}</td><td>{{ customer.firstName }}</td><td>{{ customer.lastName }}</td><td>{{ customer.phone }}</td><td>{{ customer.username }}</td></tr></tbody>
    </table>
  </main>
</template>

<script>
import { ref } from 'vue'

export default {
  name: 'CustomerList',
  setup () {
    const customers = ref([
      { customer_id: 1, firstName: 'สมชาย', lastName: 'ใจดี', phone: '089-111-2222', username: 'somchai' },
      { customer_id: 2, firstName: 'สมหญิง', lastName: 'ดีงาม', phone: '081-333-4444', username: 'somying' },
      { customer_id: 3, firstName: 'อนันต์', lastName: 'สุขใจ', phone: '092-555-6666', username: 'anan' }
    ])
    return { customers }
  }
}
</script>

<style scoped>
.customer-page { margin: 0 auto; max-width: 1120px; padding: 45px 24px; }.customer-page h1 { color: #173d3b; margin-bottom: 8px; }.customer-page p { color: #74827f; margin-bottom: 24px; }table { background: #fff; border-collapse: collapse; box-shadow: 0 8px 24px rgba(26, 65, 49, .06); width: 100%; }th, td { border: 1px solid #e3ebe7; padding: 14px 16px; text-align: left; }th { background: #e8f5ed; color: #286f4c; font-size: 13px; }td { color: #42534e; font-size: 13px; }
</style>
