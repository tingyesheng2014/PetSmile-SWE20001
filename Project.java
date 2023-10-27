public class Project
{
    public static double Average(int[] arr) {
        int total = 0;
        for (int num : arr) {
            total += num;
        }
        double average = (double) total / arr.length;
        return average;
    }

    public static void main(String[] args) {
        int[] numbers = {5, 8, 12, 15, 20};

        double averageResult = Average(numbers);
        System.out.println("Average: " + averageResult);
        
        if (averageResult >= 10) {
            System.out.println("Double digits");
        } else {
            System.out.println("Single digits");
        }
    }
}

