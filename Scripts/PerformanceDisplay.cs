// PerformanceDisplay.cs
using UnityEngine;
using TMPro;

public class PerformanceDisplay : MonoBehaviour
{
    public TextMeshProUGUI speedText;
    public TextMeshProUGUI distanceText;
    public TextMeshProUGUI packagesPickedText;
    public TextMeshProUGUI alphaText;
    public TextMeshProUGUI betaText;
    public TextMeshProUGUI qText;

    private float speed;
    private float distance;
    private int packagesPicked;
    private float alpha;
    private float beta;
    private float Q;

    void Start()
    {
        // Set initial values (these can be dynamically updated)
        speed = 10f;
        distance = 0f;
        packagesPicked = 0;
        alpha = 1f;
        beta = 2f;
        Q = 1f;

        UpdateUI();
    }

    public void UpdatePerformance(float newSpeed, float newDistance, int newPackagesPicked)
    {
        speed = newSpeed;
        distance = newDistance;
        packagesPicked = newPackagesPicked;
        UpdateUI();
    }

    public void UpdateACOParameters(float newAlpha, float newBeta, float newQ)
    {
        alpha = newAlpha;
        beta = newBeta;
        Q = newQ;
        UpdateUI();
    }

    void UpdateUI()
    {
        speedText.text = $"Speed: {speed:F2}";
        distanceText.text = $"Distance: {distance:F2}";
        packagesPickedText.text = $"Packages Picked: {packagesPicked}";
        alphaText.text = $"Alpha: {alpha:F2}";
        betaText.text = $"Beta: {beta:F2}";
        qText.text = $"Q: {Q:F2}";
    }
}
