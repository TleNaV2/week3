<template>
  <div class="container page">
    <div class="header-row">
      <div>
        <h1>ข้อมูลพนักงาน</h1>
        <p class="lead">รายชื่อพนักงานทั้งหมด</p>
      </div>
      <router-link to="/add-employee" class="btn btn-primary">เพิ่มพนักงานพนักงาน</router-link>
    </div>

    <table class="employee-table">
      <thead>
        <tr>
          <th>ลำดับที่</th>
          <th>รหัสพนักงาน</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>เบอร์โทร</th>
          <th>ชื่อผู้ใช้</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(employee, index) in employees" :key="employee.emp_id">
          <td>{{ index + 1 }}</td>
          <td>{{ employee.emp_id }}</td>
          <td>{{ employee.firstName }}</td>
          <td>{{ employee.lastName }}</td>
          <td>{{ employee.phone }}</td>
          <td>{{ employee.username }}</td>
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
  name: 'EmployeeTable',

  setup () {
    const employees = ref([])
    const loading = ref(true)
    const error = ref(null)

    const fetchEmployees = async () => {
      try {
        const response = await fetch('http://localhost/week3_68704511/php.api/show_employee.php')

        if (!response.ok) {
          throw new Error('ไม่สามารถดึงข้อมูลพนักงานได้')
        }

        const result = await response.json()

        if (!result.success || !Array.isArray(result.data)) {
          throw new Error(result.message || 'รูปแบบข้อมูลพนักงานไม่ถูกต้อง')
        }

        employees.value = result.data
      } catch (err) {
        error.value = err.message
      } finally {
        loading.value = false
      }
    }

    onMounted(() => {
      fetchEmployees()
    })

    return {
      employees,
      loading,
      error
    }
  }
}
</script>

<style scoped>
.page { margin: 0 auto; max-width: 1120px; padding: 40px 24px 60px; }
.page h1 { color: #173d3b; }
.lead { color: #6c757d; margin-bottom: 24px; }
.header-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}
.btn {
  border-radius: 10px;
}
.employee-table { background: #fff; border-collapse: collapse; width: 100%; }
.employee-table th, .employee-table td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
.employee-table th { background: #212529; color: #fff; }
.text-center { text-align: center; }
.alert { margin-top: 16px; }
</style>
