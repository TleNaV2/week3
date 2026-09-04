<template>
  <div class="container page">
    <h1>ข้อมูลพนักงาน</h1>
    <p class="lead">รายชื่อพนักงานทั้งหมด</p>
    <table class="employee-table">
      <thead><tr><th>ลำดับ</th><th>รหัสพนักงาน</th><th>ชื่อ-สกุล</th><th>แผนก</th><th>สถานะ</th></tr></thead>
      <tbody>
        <tr v-for="(employee, index) in employees" :key="employee.emp_id">
          <td>{{ index + 1 }}</td><td>{{ employee.emp_id }}</td><td>{{ employee.full_name }}</td><td>{{ employee.department }}</td>
          <td><span v-if="employee.active" class="active">ทำงานอยู่</span><span v-else class="resigned">ลาออก</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { ref } from 'vue'

export default {
  name: 'EmployeeTable',
  setup () {
    const employees = ref([
      { emp_id: 1, full_name: 'สมชาย ใจดี', department: 'IT', active: true },
      { emp_id: 2, full_name: 'สมหญิง ดีงาม', department: 'บัญชี', active: true },
      { emp_id: 3, full_name: 'อนันต์ สุขใจ', department: 'การตลาด', active: false },
      { emp_id: 4, full_name: 'สุดา พรมดี', department: 'ทรัพยากรบุคคล', active: true }
    ])
    return { employees }
  }
}
</script>

<style scoped>
.page { margin: 0 auto; max-width: 1120px; padding: 40px 24px 60px; }.page h1 { color: #173d3b; }.lead { color: #6c757d; margin-bottom: 24px; }.employee-table { background: #fff; border-collapse: collapse; width: 100%; }.employee-table th, .employee-table td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }.employee-table th { background: #212529; color: #fff; }.active { color: #198754; font-weight: 600; }.resigned { color: #dc3545; font-weight: 600; }
</style>
